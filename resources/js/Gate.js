export default class Gate{
    constructor(user){
        this.user = user;
    }
    isAdmin(){
        return this.user.tipo == 1;
    }
    isUser(){
        return this.user.tipo == 0;
    }
}