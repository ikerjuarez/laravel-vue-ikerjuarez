<template>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1>Reservations List</h1>
        </div>
        <div v-if="valoration" class="d-flex justify-content-center">
            <form @submit.prevent="makeValoration(valoracio)" class="row">
                <div class="col-sm-2">
                    <label for="inputGameId" class="form-label">Game to valorate</label>
                    <input type="number" id="inputGameId" class="form-control" :value="valoracio.id_joc" readonly>
                </div>
                <div class="col-sm-2">
                    <label for="inputUserId" class="form-label">User</label>
                    <input class="form-control" type="number" id="inputUserId" :value="valoracio.id_user" readonly>
                </div>
                <div class="col-sm-4">
                    <label for="inputValoration" class="form-label">Valoration</label>
                    <input class="form-control" type="number" placeholder="Please, write a number between 1 and 5" id="inputValoration" v-model="valoracio.val">
                </div>
                <div class="col-sm-4">
                    <label for="inputComment" class="form-label">Comment</label>
                    <input class="form-control" type="text" placeholder="You can write a comment" id="inputComment" v-model="valoracio.comment">
                </div>
                <div class="col-sm-4 align-self-center">
                    <input type="submit" value="Make valoration" class="btn btn-success">
                    <button class="btn btn-danger" type="submit" @click="cancel()">Cancel</button>
                </div>
            </form>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <td>ID</td>
                    <td>User</td>
                    <td>Date</td>
                    <td>State</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in reserves" :key="index">
                    <td>{{item.id}}</td>
                    <td>{{item.user.name}}</td>
                    <td>{{item.date}}</td>
                    <td v-if="item.isAccepted === 0">pending review ...</td>
                    <td v-else>Reservation accepted!!!</td>
                    <td>
                        <button class="btn btn-danger btn-sm"
                                @click="deleteReservation(item, index)">Cancel reservation
                        </button>
                        <button v-if="item.isAccepted === 1" class="btn btn-primary btn-sm"
                                @click="showValoration(item)">Make valoration
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {

            reserves: [],
            valoracio: {id_joc: '', id_user: '', val: '', comment: ''},
            valoration: false
        }
    },

    created() {
        axios.get('/reserves')
            .then(res => {
                res.data.forEach(element => {
                    let reserva = {id: null, user: [], date: '', game_id: '', isAccepted: null}
                    reserva.id = element.id;
                    axios.get(`/user/${element.user_id}`)
                        .then(res => {
                            reserva.user = res.data
                        })
                    reserva.date = element.date;
                    reserva.game_id = element.game_id;
                    reserva.isAccepted = element.isAccepted;
                    this.reserves.push(reserva);
                })
            })
    },

    methods: {

        deleteReservation(reserva, index) {
            const confirmacio = confirm(`Are you sure to cancel this booking? \nClick continue to delete it, otherwise, click cancel.`);
            if (confirmacio) {
                axios.delete(`/reserves/${reserva.id}`)
                    .then(() => {
                        this.reserves.splice(index, 1);
                    })
            }
        },

        showValoration(item){
            this.valoration = true;
            console.log(item)
            this.valoracio.id_joc = item.game_id;
            this.valoracio.id_user = item.user.id;
        },

        cancel(){
            this.valoration = false;
            this.valoracio.val = '';
            this.valoracio.comment = '';
            this.valoracio.id_joc= null;
            this.valoracio.id_user = null;
        },

        makeValoration(valoracio){
            if(valoracio.val <= 0 || valoracio.val >= 6 || valoracio.val === ''){
                alert("Incorrect value, select a number between 1 and 5.")
                return;
            }

            const params = {
                id_joc: valoracio.id_joc,
                id_user: valoracio.id_user,
                val: valoracio.val,
                comment: valoracio.comment
            }

            valoracio.val = '';
            valoracio.comment = '';
            valoracio.id_joc= null;
            valoracio.id_user = null;

            axios.post('/valoracions', params)
                .then(res => {
                    alert("Your valoration was created successfully!!!")
                    this.valoration = false;
                })
        }
    }
}
</script>
