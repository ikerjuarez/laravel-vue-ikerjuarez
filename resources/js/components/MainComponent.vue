<template>
    <div class="container">
        <div v-if="gameView">
            <div class="row">
                    <h1 class="col">Game View</h1>
                    <form class="col">
                        <input type="text" readonly :value="jocView.name" class="form-control">
                        <input type="text" readonly :value="jocView.duration" class="form-control">
                        <input type="text" readonly :value="jocView.room_id" class="form-control">
                    </form>
            </div>
            <br>
            <div v-if="jocView.valoracions.length !== 0">
                <h1>Valorations</h1>
                <div class="d-flex justify-content-center">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <td>Joc</td>
                                <td>Usuari</td>
                                <td>Valoracio</td>
                                <td>Comentari</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in jocView.valoracions" :key="index">
                                <td>{{item.id_joc}}</td>
                                <td>{{item.id_user}}</td>
                                <td>{{item.valoracio}}</td>
                                <td>{{item.comentari}}</td>
                            </tr>
                        </tbody>
                        <button class="btn btn-danger" type="submit" @click="cancel()">Cancel</button>
                    </table>
                </div>
            </div>
            <div v-else>
                <h1>There's no valorations yet.</h1>
            </div>
        </div>
        <div v-else>
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
                                <button class="btn btn-primary btn-sm" @click="seeGameView(item)">See Game</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-if="jocs.length !== 0">
                <p>Want to make a reservation? <a style="text-decoration: none" href="/makeReservation">Click this link!</a></p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            jocs: [],
            joc: {name: '', duration: '', room_id: ''},
            gameView: false,
            jocView: {name: '', duration: '', room_id: '', valoracions: []}
        }
    },
    created(){
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
    },

    methods: {

        seeGameView(item){

            this.gameView = true;
            this.jocView.name = item.name;
            this.jocView.duration = item.duration;
            this.jocView.room_id = item.room_id;

            console.log(item.id)
            axios.get(`/valoracions/${item.id}`)
                .then(res => {
                    this.jocView.valoracions = res.data;
                })

        },
        cancel(){
            this.gameView = false;
            this.jocView.name = '';
            this.jocView.duration = '';
            this.jocView.room_id = null;
            this.jocView.valoracions = [];
        }
    }
}
</script>
