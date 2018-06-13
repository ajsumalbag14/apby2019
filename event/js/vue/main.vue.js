var app = new Vue({
    el: '#app',
    data: {
      title: 'Hello Vue!',
      profile: {
          affiliation : '',
          firstname : '',
          lastname : '',
          gender : '',
          mobile : '',
          email : '',
          birthdate : ''
      }
    },
    method: {
        onSubmit() {
            
        }
    }
  })