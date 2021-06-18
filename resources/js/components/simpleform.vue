<template>
<div>
  <div class="row">
    <div class="col">
        <input type="text" v-model="title" class="form-control" placeholder="data">
    </div>
  </div>
  <button type="submit" @click="save" class="btn btn-primary mb-2">save</button>
</div>
</template>

<script>

export default {
    data() {
        return {
            title: '',
            presets: ''
        }
    },
    methods: {
        save() {
            axios.post('/api/v1/user/simple',{
                title: this.title,
            }).then(response => {
                this.response = JSON.stringify(response, null, 2)
            }).catch(error => {
                this.response = 'Error: ' + error.response.status
            })
        }
    },
}
</script>
