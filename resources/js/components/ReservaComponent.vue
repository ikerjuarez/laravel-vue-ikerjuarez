<template>
  <div class="container">
      <div v-if="reservation">
          <div class="d-flex justify-content-center">
              <h1>Make reservation to game: </h1>
          </div>
          <div class="d-flex justify-content-center">
              <form @submit.prevent="makeReservation(reserva)" class="row">
                  <div class="col-sm-4">
                      <label for="inputDate" class="form-label">Day to book</label>
                      <input type="datetime-local" id="inputDate" class="form-control" v-model="reserva.date">
                  </div>
                  <div class="col-sm-4">
                      <label for="inputGameId" class="form-label">Game Id</label>
                      <input class="form-control" type="number" id="inputGameId" :value="reserva.game_id" readonly>
                  </div>
                  <div class="col-sm-4">
                      <label for="inputRoomId" class="form-label">Room Id</label>
                      <input class="form-control" type="number" id="inputRoomId" :value="reserva.room_id" readonly>
                  </div>
                  <div class="col-sm-4 align-self-center">
                      <input type="submit" value="Make reservation" class="btn btn-success">
                      <button class="btn btn-danger" type="submit" @click="cancel()">Cancel</button>
                  </div>
              </form>
          </div>
      </div>
      <div class="d-flex justify-content-center">
          <h1>Reservations List</h1>
      </div>
      <div class="row d-flex justify-content-center">
          <div class="card col-sm-4" style="width: 18rem; margin: 10px; " v-for="(item, index) in jocs" :key="index">
              <h5 class="card-header">{{item.name}}</h5>
              <div class="card-body">
                  <button class="btn btn-primary" @click="showReservation(item)">Make a reservation</button>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return {
            jocs: [],

            reserves: [],

            reserva: {date: '',game_id: '', room_id: ''},

            reservation: false
        }
    },

    created() {

        axios.get('/reserves')
            .then(res => {
                this.reserves = res.data;
            })

        axios.get('/games')
            .then(res => {
                console.log(res.data)
                this.jocs = res.data;
            })
    },

    methods: {
        showReservation(item){
            this.reservation = true;
            this.reserva.date = null;
            this.reserva.game_id = item.id;
            this.reserva.room_id = item.room_id;

        },

        makeReservation(reserva){
            if(reserva.date.trim() === ''){
                alert("Please, select a date and hour to make a reservation.");
                return;
            }

            const params = {
                date: reserva.date,
                game_id: reserva.game_id
            }

            reserva.date = '';
            reserva.game_id = null;
            reserva.room_id = null;

            axios.post('/reserves', params)
                .then(res => {
                    this.reserves.push(res.data);
                })
        },

        cancel(){
            this.reservation = false;
            this.reserva.date = '';
            this.reserva.game_id = null;
            this.reserva.room_id = null;
        },
    }
}
</script>
