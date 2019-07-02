class myVar {
    constructor() {
        if (!!myVar.instance) {
            return myVar.instance;
        }

        myVar.instance = this;
        return this;
    }
    setId(id){
        this.id=id;
    }
    getId() {
        return this.id;
    }
    //store information
    setsName(sname){
        this.sname=sname;
    }
    setsState(state){
        this.state=state;
    }
    setsLong(slong){
        this.slong=slong;
    }
    setsLat(slat){
        this.slat=slat;
    }
    setsPhone(phone){
        this.phone=phone;
    }
    setsDis(dis){
        this.dis=dis;
    }
    setsClose(close){
        this.close=close;
    }

    getsName() {
        return this.sname;
    }
    getsLong() {
        return this.slong;
    }
    getsLat() {
        return this.slat;
    }
    getsPhone() {
        return this.phone;
    }
    getsDis() {
        return this.dis;
    }
    getsClose() {
        return this.close;
    }
    getsState() {
        return this.state;
    }

    //getmaxrecordID
    setsRecordID(record){
        this.record=record;
   }
   getsRecordID(){
        return this.record;
   }

   //getProductID
   setProductID(pid){
        this.pid=pid;
   }
   getProductID(){
       return this.pid;
   }

   //getOrderRecordID
    setoRecordID(record){
    this.record=record;
    }
    getoRecordID(){
        return this.record;
    }
}