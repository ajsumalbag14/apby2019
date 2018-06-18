var app = new Vue({
    el: '#app',
    data() {
        return {
            title: 'Hello Vue!',
            profile: {
                firstname : '',
                lastname : '',
                middlename : '',
                nickname : '',
                gender : '',
                mobile : '',
                email : '',
                affiliation : '',
                role : ''
            }
      }
    },
    methods: {
        onSubmit: function() {
            let d = this
            axios.post('http://localhost/apby2019/api/public/reg/profile/new', 
            {                
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
                if (JSON.stringify(resp.code) == 200) {
                    if (JSON.stringify(resp.status) == 'PR002')
                    console.log( "Error: " + JSON.stringify(resp.message, '"'));
                    else
                    console.log(JSON.stringify(resp.message));
                }
                else 
                console.log('Error: ' + JSON.stringify(resp.message))
                //clear
                d.unsetVariables()

            })
            .catch(error => {
                console.log(error);
            });
        },
        unsetVariables: function() {
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