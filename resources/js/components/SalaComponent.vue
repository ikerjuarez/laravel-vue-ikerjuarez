<template>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 v-if="edit">Update Room</h1>
            <h1 v-else>Create Room</h1>
        </div>
        <div class="d-flex justify-content-center">
            <form @submit.prevent="editSala(sala)" class="row" v-if="edit">
                <div class="col-sm-4">
                    <label for="inputNameEdit" class="form-label">Room name</label>
                    <input type="text" id="inputNameEdit" class="form-control" v-model="sala.name">
                </div>
                <div class="col-sm-4">
                    <label for="inputCapacityEdit" class="form-label">Room capacity</label>
                    <input type="number" id="inputCapacityEdit" class="form-control" v-model="sala.capacity">
                </div>
                <div class="col-sm-4 align-self-center">
                    <input type="submit" value="Edit room" class="btn btn-success">
                    <button class="btn btn-danger" type="submit" @click="cancel()">Cancel</button>
                </div>
            </form>
            <form @submit.prevent="agregar" class="row" v-else>
                <div class="col-sm-4">
                    <label for="inputName" class="form-label">Room name</label>
                    <input type="text" id="inputName" class="form-control" v-model="sala.name">
                </div>
                <div class="col-sm-4">
                    <label for="inputCapacity" class="form-label">Room capacity</label>
                    <input type="number" id="inputCapacity" class="form-control" v-model="sala.capacity">
                </div>
                <div class="col-sm-4 align-self-center">
                    <input type="submit" value="Create room" class="btn btn-success">
                </div>
            </form>
        </div>
        <div>
            <div class="d-flex justify-content-center mt-5">
                <h1>Rooms List</h1>
            </div>
            <div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <td>Name</td>
                            <td>Capacity</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in sales" :key="index">
                            <td>{{item.name}}</td>
                            <td>{{item.capacity}}</td>
                            <td>
                                <button class="btn btn-danger btn-sm"
                                        @click="deleteSala(item, index)">Delete
                                </button>
                                <button class="btn btn-warning btn-sm"
                                        @click="editViewSala(item)">Edit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            sales: [],

            sala: {name: '', capacity: ''},

            edit: false
        }
    },

    created(){
        axios.get('/rooms')
        .then(res => {
            this.sales = res.data;
        })
    },

    methods:{
        agregar(){
            if(this.sala.name.trim() === '' || this.sala.capacity.trim() === ''){
                alert('Dont leave fields blank!!');
                return;
            }

            const params = {
                name: this.sala.name,
                capacity: this.sala.capacity
            }
            this.sala.name = '';
            this.sala.capacity = '';

            axios.post('/rooms',params)
                .then(res => {
                    this.sales.push(res.data)
                })

        },

        editViewSala(item){
            this.edit = true;
            this.sala.name = item.name;
            this.sala.capacity = item.capacity;
            this.sala.id = item.id;
        },

        editSala(sala){

            const params = {name: sala.name, capacity: sala.capacity}
            axios.put(`/rooms/${sala.id}`, params)
                .then(res => {
                    this.edit = false;
                    const index = this.sales.findIndex(item => item.id === sala.id);
                    console.log(res.data)
                    this.sales[index].name = res.data.name;
                    this.sales[index].capacity = res.data.capacity;

                    this.sala = {nom: '', capacity: ''}

                    axios.get('/rooms')
                        .then(res => {
                            this.sales = res.data;
                        })
            })
        },

        cancel(){
            this.edit = false;
            this.sala.name = '';
            this.sala.capacity = '';
        },

        deleteSala(sala, index){
            const confirmacio = confirm(`Eliminar sala ${sala.name}`);
            if(confirmacio){
                axios.delete(`/rooms/${sala.id}`)
                    .then(()=>{
                        this.sales.splice(index, 1);
                    })
            }
        }
    }
}
</script>

