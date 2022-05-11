<template>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1>Reservations List</h1>
        </div>
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
                    <tr v-for="(item, index) in reserves" :key="index" v-if="item.isAccepted === 0">
                        <td>{{item.id}}</td>
                        <td>{{item.user.name}}</td>
                        <td>{{item.date}}</td>
                        <td>pending review ...</td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                    @click="deleteReservation(item, index)">Denegate
                            </button>
                            <button class="btn btn-warning btn-sm"
                                    @click="acceptReservation(item)">Accept
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

        deleteReservation(reserva, index){
            const confirmacio = confirm(`Eliminar reserva ${reserva.id}`);
            if(confirmacio){
                axios.delete(`/reserves/${reserva.id}`)
                    .then(()=> {
                        this.reserves.splice(index, 1);
                    })
            }
        },

        acceptReservation(reserva){
            const params = {isAccepted: true}

            axios.put(`/reserves/${reserva.id}`,params)
                .then(res => {
                    const index = this.reserves.findIndex(item => item.id === reserva.id);
                    this.reserves[index].isAccepted = res.data.isAccepted;
                })


        }

    }
}
</script>

