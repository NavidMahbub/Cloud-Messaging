export default function(Vue){

    Vue.auth = {
        setToken (token, expiration) {
            localStorage.setItem('token',token)
            localStorage.setItem('expiration',expiration)
        },
        destroyToken (){
            localStorage.removeItem('token')
            localStorage.removeItem('expiration')
        },
        getToken () {
            var token = localStorage.getItem('token')
            var expiration = localStorage.getItem('expiration')
            if(! token || ! expiration)
                return null
            if(Date.now() > parseInt(expiration)){
                this.destroyToken()
                return null
            }
            else{
                return token
            }
        },
        isAuthenticated () {
            if(this.getToken())
                return true
            else
                return false
        },
        logout(){
            this.destroyToken()
        }
    }

    Object.defineProperties(Vue.prototype,{
        $auth: {
            get: () => {
                return Vue.auth
            }
        }
    })
    
}