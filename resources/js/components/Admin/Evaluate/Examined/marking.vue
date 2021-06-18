<template> 
<div>
<div v-for="markingfor in markinglist">
        <v-card :key="studentid" tile outlined class="pa-2">
        {{markingfor.marks}} {{studentid}}
        {{markingfor.description}}
        </v-card>
</div>
<!-- SLIDER -->
    <v-card-text>
      <v-row>
        <v-col class="pr-4">
          <v-slider
            v-model="slider"
            class="align-center"
            
            @change="onChange(list.id)"
            :max="max"
            :min="min"
            hide-details
          >
            <template v-slot:append>
              <v-text-field
                v-model="slider"
                class="mt-0 pt-0"
                hide-details
                single-line
                type="number"
                style="width: 60px"
              ></v-text-field>
            </template>
          </v-slider>
        </v-col>
      </v-row>
    </v-card-text>
    <v-snackbar
      v-model="snackbar"
    >
      {{ text }}
        
      <template v-slot:action="{ attrs }">
        <v-btn
          color="pink"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
<!-- SLIDER -->
</div>
</template>

<script>
export default {
    props: ['list','studentid'],
    data: function() {
        return {
            snackbar: false,
            text: 'Action saved',
            markinglist: [],
            min: 0,
            max: 4,
            slider: 0,
            savedmarking: 0,
        }
    },
    methods: {
        onChange(e) {
            console.log(e);
            this.snackbar=true;
            axios.post('api/v1/user/finalmarkingbyexaminer/'+e+'/'+this.studentid+'/'+this.slider)
            .then(response => {
                console.log(response.data);
                this.$emit('itemchanged');
            })
        },
        reload: function(){

        }
    },
    mounted: function(){
        this.$nextTick().then(this.reload);
    },
    created() {
        //this.slider = this.savedmarking.map(item=>item);
        
        //console.log(this.studentid);
        axios.get('api/v1/markinglist/'+this.list.id)
        .then(response => {
            this.markinglist = response.data;
            const responseData = response.data;
            //if(responseData.map(item=>item) == 4)
            //{
            this.max = responseData.map(item=>item.marks).slice(-1)[0];
                //console.log(responseData.map(item=>item.marks).slice(-1)[0]);
            //}
            
            
        });

        axios.get('api/v1/examiner/savedmarking/'+this.list.id+'/'+this.studentid)
        .then(response => {
            //console.log(this.studentid);
            this.savedmarking = response.data;
            //console.log(this.savedmarking);
            if(this.savedmarking)
            {
                this.slider = this.savedmarking;
            }else{
                this.slider = 0;
            }
            //this.max = response.data.length-1;
            //this.slider = this.response.data;
        });
    }

}
</script>