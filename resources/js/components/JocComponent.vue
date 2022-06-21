<template>
    <div>
        <div class="d-flex justify-content-center">
            <h1>Create Game</h1>
        </div>
        <div class="d-flex justify-content-center">
            <!-- Edit form -->
            <form @submit.prevent="editGame(joc)" class="row" v-if="edit">
                <div class="col-sm-4">
                    <label for="inputNameEdit" class="form-label">Game name</label>
                    <input type="text" id="inputNameEdit" class="form-control" v-model="joc.name">
                </div>
                <div class="col-sm-4">
                    <label for="inputDurationEdit" class="form-label">Game duration</label>
                    <input type="time" id="inputDurationEdit" class="form-control" v-model="joc.duration">
                </div>
                <div class="col-sm-4">
                    <label for="inputIdSalaEdit" class="form-label">Room Id</label>
                    <select name="idRoom" id="inputIdSalaEdit" class="form-select" v-model="joc.room_id">
                        <option value="">Please, choose a room for the game</option>
                        <option v-for="sala in sales" :key="sala.name" :value="sala.id">{{sala.id + "- "+sala.name}}</option>
                    </select>
                </div>
                <div class="col-sm-4 align-self-center">
                    <input type="submit" value="Update game" class="btn btn-success">
                    <button class="btn btn-danger" type="submit" @click="cancel()">Cancel</button>
                </div>
            </form>
            <!-- Create form -->
            <form @submit.prevent="agregar" class="row" v-else>
                <div class="col-sm-4">
                    <label for="inputName" class="form-label">Game name</label>
                    <input type="text" id="inputName" class="form-control" v-model="joc.name">
                </div>
                <div class="col-sm-4">
                    <label for="inputDuration" class="form-label">Game duration</label>
                    <input type="time" id="inputDuration" class="form-control" v-model="joc.duration">
                </div>
                <div class="col-sm-4">
                    <label for="inputIdSala" class="form-label">Room Id</label>
                    <select name="idRoom" id="inputIdSala" class="form-select" v-model="joc.room_id">
                        <option value="">Please, choose a room for the game</option>
                        <option v-for="sala in sales" :key="sala.name" :value="sala.id">{{sala.id + "- "+sala.name}}</option>
                    </select>
                </div>
<!--                <div class="col-sm-4">
                    <label for="inputImage" class="form-label">Game image</label>
                    <input type="file" id="inputImage" class="form-control" v-on:change="onChange">
                </div>-->
                <div class="col-sm-4 align-self-center">
                    <input type="submit" value="Create game" class="btn btn-success">
                </div>
            </form>
        </div>
        <div>
            <div class="d-flex justify-content-center">
                <h1>Games List</h1>
            </div>
            <div>

                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <td>Name</td>
                            <td>Duration</td>
                            <td>Room</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in jocs" :key="index">
                            <td>{{item.name}}</td>
                            <td>{{item.duration}}</td>
                            <td>{{item.room_id}}</td>
                            <td>
                                <button class="btn btn-danger btn-sm"
                                        @click="deleteGame(item, index)">Delete
                                </button>
                                <button class="btn btn-warning btn-sm"
                                        @click="editViewGame(item)">Edit
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
        return{
            jocs: [],
            sales: [],
            joc: {name: '', duration: '', room_id: ''},
            edit: false
        }
    },

    created() {
        axios.get('/games')
            .then(res => {

                res.data.forEach(element => {

                    let joc = {id: null, name: '', duration: '', room_id: '', room_name: ''}
                    joc.id = element.id;
                    joc.name = element.name;
                    joc.duration = element.duration;
                    joc.room_id = element.room_id;
                    axios.get(`/rooms/${element.room_id}`)
                        .then(res => {
                            joc.room_name = res.data.name;
                        })
                    this.jocs.push(joc);
                })
            })

        axios.get('/rooms')
            .then(res => {
                this.sales = res.data
            })
    },

    methods: {

        /*onChange(e){
            this.joc.imgName = e.target.files[0].name;
            console.log(this.joc.imgName)
        },*/

        agregar(){

            if(this.joc.name.trim() === '' || this.joc.duration.trim() === ''){
                alert('Dont leave fields blank!!');
                return;
            }

            const params = {
                name: this.joc.name,
                duration: this.joc.duration,
                room_id: this.joc.room_id,
            }

            this.joc.name = '';
            this.joc.duration = '';
            this.joc.room_id = '';

            axios.post('/games', params)
                .then(res => {
                    this.jocs.push(res.data);
                })
        },

        editViewGame(item){
            this.edit = true;
            this.joc.name = item.name;
            this.joc.duration = item.duration;
            this.joc.room_id = item.room_id;
            this.joc.id = item.id;
        },

        editGame(joc){

            const params = {name: joc.name, duration: joc.duration, room_id: joc.room_id}
            axios.put(`/games/${joc.id}`, params)
                .then(res => {
                    this.edit = false;
                    const index = this.jocs.findIndex(item => item.id === joc.id);
                    console.log(res.data)
                    this.jocs[index].name = res.data.name;
                    this.jocs[index].duration = res.data.duration;
                    this.jocs[index].room_id = res.data.room_id;

                    this.joc = {nom: '', duration: '', room_id: null}

                    axios.get('/games')
                        .then(res => {
                            this.jocs = res.data;
                        })
                })
        },

        cancel(){
            this.edit = false;
            this.joc.name = '';
            this.joc.duration = '';
            this.joc.room_id = null;
            this.joc.imgName = '';
        },

        deleteGame(game, index){
            const confirmacio = confirm(`Eliminar joc ${game.name}`);
            if(confirmacio){
                axios.delete(`/games/${game.id}`)
                    .then(()=>{
                        this.jocs.splice(index, 1);
                    })
            }
        }
    }
}
</script>

