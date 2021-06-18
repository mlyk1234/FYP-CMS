<template>
<div>
  <div class="row">
    <div class="col">
        <div v-for="preset in presets">
        <input type="text" v-model="preset.title" class="form-control" :placeholder="preset.title" value="hi">
        </div>
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
    created() {
        axios.get('/api/v1/user/simple')
        .then( response => ( this.presets = response.data ) )
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
