export default class Gate{
    constructor(user){
        this.user = user
    }
    isAdmin(){
        return this.user.tipo == 1;
    }
    isUser(){
        return this.user.tipo == 0;
    }
    // accesosUser(id_modulo){
    //     var accesosUsuario={}
    //     console.log("HOLA")
    //     //axios.get("api/modulosAccesos2/"+this.user.id).then((response) => console.log(response.data));
    //     axios.get("api/modulosAccesos2/"+this.user.id).then((response) => (accesosUsuario=response.data, console.log(response.data)));
    //     return accesosUsuario
    // }
}