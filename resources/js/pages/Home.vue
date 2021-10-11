<template>
    <div>

      <h2 style="font-family:times new romans; font-weight:bold; color:green;">Add An Item </h2>
        <form @submit.prevent="addItem" class="mb-3">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Name<span style="color: red;">*</span></label>
                    <input type="text" autofocus="autofocus" class="form-control" v-model="myItem.name" autocomplete="off">
                </div>
                    
                <div class="form-group col-md-3">
                    <label>Started<span style="color: red;">*</span></label>
                    <input type="text" autofocus="autofocus" class="form-control" v-model="myItem.started" autocomplete="off">
                </div>
                <div class="form-group col-md-3">
                    <label>Interval<span style="color: red;">*</span></label>
                    <input type="text" autofocus="autofocus" class="form-control" v-model="myItem.interval" autocomplete="off">
                </div>
          
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <button id="submit" type="submit" class="btn btn-outline-success btn-block">Save</button>
                </div>
                <div class="form-group col-md-6">
                    <button type="button" @click="clearFormI()" class="btn btn-outline-danger btn-block">Refresh</button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <div class="card-header bg-success" style="text-transform:uppercase;  color:#fff; font-size:25px; font-family:times new romans; text-align:center">JSON FILE <b>SCHEDULES</b> APP </div>
                <div style="overflow-x: auto">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Started</th>
                            <th>Interval</th>
                            <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="myJson in myItems" v-bind:key="myJson.j_id">
                                <td>{{myJson.j_id}}</td>
                                <td>{{myJson.name}}</td>
                                <td>{{myJson.started}}</td>
                                <td>{{myJson.interval}}</td>
                                <td>
                                    <a @click="showItem(myJson)"  class="btn btn-success btn-xs" href="#" ><i class="fa fa-pencil"></i> </a>
                                    <a @click="deleteItem(myJson.j_id)" class="btn btn-danger btn-xs" href=""> <i class="fa fa-trash text-red"></i></a>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr><br>
                <hr><br>
                <h2 style="font-family:times new romans; font-weight:bold; color:green;">Add A Holiday </h2>
                <form @submit.prevent="addHoliday" class="mb-3">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Name<span style="color: red;">*</span></label>
                            <input type="text" autofocus="autofocus" class="form-control" v-model="myHoliday.name" autocomplete="off">
                        </div>
                            
                        <div class="form-group col-md-3">
                            <label>Day<span style="color: red;">*</span></label>
                            <input type="text" autofocus="autofocus" class="form-control" v-model="myHoliday.day" autocomplete="off">
                        </div>
                
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button id="submit2" type="submit" class="btn btn-outline-success btn-block">Save</button>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="button" @click="clearFormH()" class="btn btn-outline-danger btn-block">Refresh</button>
                        </div>
                    </div>
                </form>
                <div style="overflow-x: auto">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Day</th>
                            <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="myJson in myHolidays" v-bind:key="myJson.j_id">
                                <td>{{myJson.j_id}}</td>
                                <td>{{myJson.name}}</td>
                                <td>{{myJson.day}}</td>
                                <td>
                                    <a @click="showHoliday(myJson)"  class="btn btn-success btn-xs" href="#" ><i class="fa fa-pencil"></i> </a>
                                    <a @click="deleteHoliday(myJson.j_id)" class="btn btn-danger btn-xs" href=""> <i class="fa fa-trash text-red"></i></a>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <br><hr>

        
        <div class="card">
            <div class="card-body">
                <div class="card-header bg-success" style="text-transform:uppercase;  color:#fff; font-size:25px; font-family:times new romans; text-align:center">Next <b>Service</b> Table </div>
                <div style="overflow-x: auto">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Next</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(myJson, iIndex) in myScheduleItems">
                                <td>{{iIndex}}</td>
                                <td>{{myJson.name}}  {{myJson.started}}</td>
                                <div  v-for="(mySched, nIndex) in mySchedule">

                                    <span v-if="nIndex == iIndex">
                                        <span  v-for="(myNext, n) in mySched"><span class="badge badge-primary mr-1 ml-1">{{myNext}}</span></span>
                                    </span>
                                </div>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</template>

<script>

    export default {
        data() {
            return {

                oJson: {},
                mySchedule: [],
                myScheduleItems:[],

                myHolidays: [],
                myHoliday: {
                    name: '',
                    day: '',
                    j_id: ''
                },

                myItems: [],
                myItem: {
                    name: '',
                    started: '',
                    interval: '',
                    j_id: ''
                },
                pagination: {},
                msgs: {},
                edit: false
            
            };
        },

        created() {
            this.fetchItems();
            this.fetchHolidays();
            this.fetchSchedule();
        },

        methods: {

            fetchSchedule(page_url) {
                let paginate = this;
                page_url = page_url || '/api/getSchedule';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.mySchedule = res.next;
                        this.myScheduleItems = res.items;
                        console.log(this.mySchedule)
                        console.log(this.myScheduleItems)
                        // alert(res)
                        let mylinks = res.links;
                        let pagination = {
                        };

                    })
                    .catch(err => console.log(err));
                },

                deleteShedule(j_id) {
                    
                if (confirm('Are You Sure You Want to Delete?' )) {
                    
                }
            },

            fetchItems(page_url) {
                let paginate = this;
                page_url = page_url || '/api/getAllItem';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.myItems = res;
                        // alert(res)
                        let mylinks = res.links;
                        let pagination = {
                        };

                    })
                    .catch(err => console.log(err));
                },

                deleteItem(j_id) {
                    
                if (confirm('Are You Sure You Want to Delete?' )) {
                    fetch(`api/removeItem/${j_id}`, {
                    method: 'get'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Removed Successfully!');
                        this.fetchItems();
                        this.fetchSchedule();
                    })
                    .catch(err => console.log(err));
                }
            },

            // Add New Item

            addItem() {

                let currentObj = this;

                if (this.edit === false) {
                    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
        
                    let formData = new FormData();
                    formData.append('name', this.myItem.name);
                    formData.append('started', this.myItem.started);
                    formData.append('interval', this.myItem.interval);
    
                    axios.post('api/saveItem', formData, config)
                    .then(function (response) {
                        // alert(response.data.success);
                        if(response.data.success == 'Done'){
                            //
                            currentObj.clearFormI();
                            alert('Added Successfully!');
                            currentObj.fetchItems();
                            currentObj.fetchSchedule();
                        }else{
                            //
                            alert(response.data.success);
                        }
                    })
                    .catch(function (error) {
                        alert(error);
                    });

                } else {
                    // Update
                    
                    let oldJson = this.oJson;

                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
        
                    let formData = new FormData();
                    formData.append('name', this.myItem.name);
                    formData.append('started', this.myItem.started);
                    formData.append('interval', this.myItem.interval);
                    formData.append('j_id', this.myItem.j_id);

                    axios.post('api/updateItem', formData, config)
                    .then(function (response) {
                        // alert(response.data.success);
                        if(response.data.success == 'Done'){
                            //
                            currentObj.clearFormI();
                            alert('Updated Successfully!');
                            currentObj.fetchItems();
                            currentObj.fetchSchedule();
                        }else{
                            //
                            alert(response.data.success);
                        }
                    })
                    .catch(function (error) {
                        alert(error);
                    });
                    
                }
            },

            showItem(myJson) {
                console.log(myJson);
                this.edit = true;
                this.myItem.j_id = myJson.j_id;
                this.myItem.name = myJson.name;
                this.myItem.started = myJson.started;
                this.myItem.interval = myJson.interval;
                // console.log(this.myItem);
                // alert(this.myItem.interval)
                $('#submit').text('Edit');
            },
            clearFormI() {
                this.myItem.j_id = '';
                this.myItem.name = '';
                this.myItem.started = '';
                this.myItem.interval = '';
                this.edit = false;
                $('#submit').text('Save');
            },

            // ////////////
            fetchHolidays(page_url) {
                let paginate = this;
                page_url = page_url || '/api/getAllHoliday';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.myHolidays = res;
                        // alert(res)

                    })
                    .catch(err => console.log(err));
                },

                deleteHoliday(j_id) {
                    
                if (confirm('Are You Sure You Want to Delete?' )) {
                    fetch(`api/removeHoliday/${j_id}`, {
                    method: 'get'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Removed Successfully!');
                        this.fetchHolidays();
                        this.fetchSchedule();
                    })
                    .catch(err => console.log(err));
                }
            },

            // Add New Item

            addHoliday() {

                let currentObj = this;

                if (this.edit === false) {
                    
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
        
                    let formData = new FormData();
                    formData.append('name', this.myHoliday.name);
                    formData.append('day', this.myHoliday.day);
    
                    axios.post('api/saveHoliday', formData, config)
                    .then(function (response) {
                        // alert(response.data.success);
                        if(response.data.success == 'Done'){
                            //
                            currentObj.clearFormH();
                            alert('Added Successfully!');
                            currentObj.fetchHolidays();
                            currentObj.fetchSchedule();
                        }else{
                            //
                            alert(response.data.success);
                        }
                    })
                    .catch(function (error) {
                        alert(error);
                    });

                } else {
                    // Update
                    
                    let oldJson = this.oJson;

                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
        
                    let formData = new FormData();
                    formData.append('day', this.myHoliday.day);
                    formData.append('name', this.myHoliday.name);
                    formData.append('j_id', this.myHoliday.j_id);

                    axios.post('api/updateHoliday', formData, config)
                    .then(function (response) {
                        // alert(response.data.success);
                        if(response.data.success == 'Done'){
                            //
                            currentObj.clearFormH();
                            alert('Updated Successfully!');
                            currentObj.fetchHolidays();
                            currentObj.fetchSchedule();
                        }else{
                            //
                            alert(response.data.success);
                        }
                    })
                    .catch(function (error) {
                        alert(error);
                    });
                    
                }
            },

            showHoliday(myHoliday) {
                this.edit = true;
                this.myHoliday.j_id = myHoliday.j_id;
                this.myHoliday.name = myHoliday.name;
                this.myHoliday.day = myHoliday.day;
                $('#submit2').text('Edit');
            },
            clearFormH() {
                this.myHoliday.j_id = '';
                this.myHoliday.name = '';
                this.myHoliday.day = '';
                this.edit = false;
                $('#submit2').text('Save');
            }
        }
    };

    $(document).ready(function(){
        if (this.edit === false) {
            $("#get_avater").hide();
        }
        
    })
</script>