var app = new Vue({
    el: '#app',
    data() {
        return {
            title: 'Hello Vue!',
            profile: {
                country: '',
                firstname : '',
                lastname : '',
                middlename : '',
                nickname : '',
                gender : '',
                mobile : '',
                email : '',
                affiliation : '',
                role : ''
            },
            alert_error: false,
            err_msg: '',
            alert_success: false,
            suc_msg: ''
      }
    },
    methods: {
        onSubmit: function() {
            let d = this
            axios.post('http://localhost/apby2019/api/public/reg/profile/new', 
            {                
                country: d.profile.country,
                firstname: d.profile.firstname,
                lastname: d.profile.lastname,
                middlename: d.profile.middlename,
                nickname: d.profile.nickname,
                gender: d.profile.gender,
                email: d.profile.email,
                mobile: d.profile.mobile,
                org: d.profile.affiliation,
                role: d.profile.role
            })
            .then(response => {
                //response;
                let resp = response.data
                if (JSON.stringify(resp.code) == 200 || JSON.stringify(resp.code) == 201) {
                    if (JSON.stringify(resp.status) == 'PR001') {
                        d.alert_success = false
                        d.alert_error = true
                        d.err_msg = JSON.stringify(resp.message)
                    }
                    else
                    {
                        d.alert_error = false
                        d.alert_success = true
                        d.suc_msg = JSON.stringify(resp.message)
                        //clear
                        d.unsetVariables()
                    }
                }
                else 
                {
                    d.alert_success = false
                    d.alert_error = true
                    d.err_msg = JSON.stringify(resp.message)
                }

            })
            .catch(error => {
                console.log(error);
            });
        },
        unsetVariables: function() {
            $('#inputCountry').val('')
            $('#inputFirstName').val('')
            $('#inputLastName').val('')
            $('#inputMiddleName').val('')
            $('#inputNickName').val('')
            $('#inputGender').val('')
            $('#inputEmail').val('')
            $('#inputMobile').val('')
            $('#inputAffiliation').val('')
            $('#inputRole').val('')
        }
    }
  })