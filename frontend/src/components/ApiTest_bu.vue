<script>
  export default {
    data: () => ({
      apiResponse: null,
      selectedUser: null
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
        $('#exampleModal').modal('show');
      },
      closeModal() {
        this.selectedUser = null;
        $('#exampleModal').modal('hide');
      },
      async fetchUserWeatherData() {
        const url = 'http://localhost/user_weather'
        this.apiResponse = await (await fetch(url)).json()
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
            <p>Geo-Locatio: {{ selectedUser ? selectedUser.latitude : '' }}, {{ selectedUser ? selectedUser.longitude : '' }}</p>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
