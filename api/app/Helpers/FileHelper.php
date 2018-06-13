<?php
namespace App\Helpers;


use App\Contracts\FileInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class FileHelper implements FileInterface
{
    public function generateCSV($prefix = '', $data = [])
    {
        $file_name = $prefix.'-'.Carbon::now();
        // Set Response headers
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename='.$file_name.'.csv',
            'Expires'             => '0',
            'Pragma'              => 'public',
        ];

        // Add headers for each column in the CSV download
        array_unshift($data, array_keys($data[0]));

        // Populate CSV data
        $file_content = function() use ($data) {
            $file_stream = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($file_stream, $row);
            }
            fclose($file_stream);
        };

        // Prepare response
        return [
            'code'		=> '200',
            'headers'	=> $headers,
            'content'	=> $file_content
        ];
    }
    
    public function upload(Request $request, $file_parameter = "", $destination = "tmp", $prefix = "")
    {
        $prefix .= "_";
        $file_name = strtoupper($prefix.substr(md5(uniqid(rand(), true)), 10, 17)).time();
        // Set default response into error
        $response = [
            'code'		=> '400',
            'status'	=> 'failed',
            'message'	=> 'Error in uploading files'
        ];
        // Check if file is existing and valid
        if ($request->hasFile($file_parameter)) {
            $file = $request->file($file_parameter);
            if ($file->isValid()) {
                // Generate file name
                $file_name = $file_name.'.'.$file->getClientOriginalExtension();
                // Move into tmp directory
                $file->move($destination, $file_name);
                // Prepare response body
                $response = [
                    'code'		=> '201',
                    'status'	=> 'success',
                    'data'		=> [
                        'file_name'		=> $file_name,
                        'destination'	=> $destination.'/'.$file_name
                    ]
                ];
            }
        }

        return $response;
    }

    /**
     * @param $path
     * @param string $fileName
     * @param string $fileExtension
     * @return array
     */
    public function download($path,$fileName="file",$fileExtension="csv")
    {
//        $file = public_path(). "/download/info.pdf";
        $file = "{$path}/{$fileName}.{$fileExtension}";

        switch ($fileExtension){
            case "pdf" :
                $headers = array(
                    'Content-Type: application/pdf',
                );
                break;

            case "csv" :
                $headers = array(
                    'Content-Type: text/csv',
                );
                break;

            case "xls" :
                $headers = array(
                    'Content-Type: application/vnd.ms-excel; charset=utf-8',
                );
                break;

            case "xlsx" :
                $headers = array(
                    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                );
                break;


            case "txt" :
                $headers = array(
                    'Content-Type: text/plain',
                );
                break;

            default :
                return [
                    'code' => 400,
                    'status' => "failed",
                    'error' => "Invalid file extension"
                ];
        }
        $filename = "{$fileName}.{$fileExtension}";
        return Response::download($file, $filename, $headers);
    }
}