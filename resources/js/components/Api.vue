<template>
<v-app>
  <div id="app">
        <v-select
          :items="result"
          item-text="name"
          item-value="id"
          label="Standard"
        ></v-select>
    <div v-for="takes in take">  {{takes.name}} - {{takes.count}}</div>

  </div>
</v-app>
</template>

<script>
export default {
  data: () => ({
    result: [{
      "id": '',
      "name": ''
    }],
    take: [],
  }),
  created() {
    axios.get('api/v1/submissiontype')
    .then( response => ( this.result = response.data ) );
    axios.get('api/v1/submittednew')
    .then( response => ( this.take = response.data ) );
  },
}
</script>