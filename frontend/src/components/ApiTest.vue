<script>
  export default {
    data: () => ({
      apiResponse: null,
      selectedUser: null,
      userWeatherData: null
    }),

    created() {
      this.fetchData()
    },

    methods: {
      async fetchData() {
        const url = 'http://localhost/'
        this.apiResponse = await (await fetch(url)).json()
      },

      openModal(user) {
        this.selectedUser = user;
        this.fetchUserWeatherData(user.email);
        $('#exampleModal').modal('show');
      },

      async fetchUserWeatherData(email) {
        const url = 'http://localhost/user_weather/'+email;
        this.userWeatherData = await (await fetch(url)).json();
      },

      closeModal() {
        this.selectedUser = null;
        $('#exampleModal').modal('hide');
      },
    }
  }
</script>

<template>
  <div v-if="!apiResponse" class="alert alert-light" role="alert">
    Pinging the api...
  </div>

  <div v-if="apiResponse">
    <p class="alert alert-light" role="alert">The api responded with: </p>

    <button v-for="(user, index) in apiResponse.users" :key="index" class="btn btn-outline-primary" style="margin: 0.5em;" @click="openModal(user)">
      {{ user.name }} 
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ selectedUser ? selectedUser.name : '' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>E-mail: {{ selectedUser ? selectedUser.email : '' }}</p>
            <p>Geo-Location: {{ selectedUser ? selectedUser.latitude : '' }}, {{ selectedUser ? selectedUser.longitude : '' }}</p>
            
            <p v-if="userWeatherData">

              {{selectedUser.name}} is experiencing <button class="btn btn-success">{{userWeatherData.weather[0].description}}</button>, with avearge temtaratures of <strong>{{userWeatherData.temp}} &deg;C</strong>, that feels more like <strong>{{userWeatherData.feels_like}} &deg;C</strong>. The humidity is at <strong>{{userWeatherData.humidity}}%</strong>, and the wind speed is <strong>{{userWeatherData.wind_speed}} m/s</strong> coming from <strong>{{userWeatherData.wind_deg}} &deg;</strong>. 


            </p>


            
            <p v-else="!userWeatherData">Fetching latest weather data...</p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
