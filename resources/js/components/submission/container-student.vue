<template>
  <div>
    <v-card>
      <v-responsive :aspect-ratio="16/9">

        <v-card-text> 
        <h3>Report Submission</h3>
            <v-select
            v-model="select"
            :items="items"
            item-text="name"
            label="Select"
            persistent-hint
            return-object
            single-line
            @input="onChange"
            ></v-select>

        </v-card-text>
            <div v-if="displayData" v-for="items in search">
            
            <v-card-text> {{items.submission_title}} {{ displayData.id }}
            <v-card class="mx-auto" max-width="auto" outlined>
                <v-list-item>
                    <v-list-item-title class="headline mb-1">{{ select.name }}</v-list-item-title>
                </v-list-item>
                <v-card-text>
                    <v-file-input label="File input" v-model="file" v-if="edit || displayData == 1"></v-file-input>
                    <v-file-input :label="items.submission_title" disabled v-else></v-file-input>
                </v-card-text>
                <v-card-actions>
                        <v-btn outlined rounded text @click="upload" v-if="edit || displayData == 1">Upload</v-btn>
                        <div v-else>
                        <a  v-bind:href="'../storage/uploads/'+items.userid+'/'+select.name+'/'+items.submission_title" download="">
                            <v-btn outlined rounded text>Download</v-btn>
                        </a>
                        <v-btn outlined rounded text @click="resubmit">Re-Submit</v-btn>
                        </div>
                </v-card-actions>
                <v-card-text>
                <v-text-field value="No Remarks" label="Supervisor" outlined readonly></v-text-field>
                <v-text-field value="No Remarks" label="Examiner" outlined readonly></v-text-field>
                </v-card-text>
            </v-card>
            </v-card-text>
            </div>
            <v-card-text>
            <span>Submitted List</span>
            <div v-for="items in presets">
                <ul>
                    <li><h3>{{items.chapter}}</h3></li>
                    <li>{{items.submission_title}}</li>
                </ul>
            </div>
            </v-card-text>
      </v-responsive>
    </v-card>
  </div>
</template>

<script>
    const index = 0;
    export default {
        
        data() {
            return { 
                newdata: 0  ,
                edit: false,
                select: '',
                items: [{
                    "name": ""
                }],
                disableSelect: false,
                file: '',
                success: '',
                download: [],
                filename: '',
                presets: [],
                search: '',
                editForm: {
                    submission_title: '',
                    file_path: '',
                },

            }
        },
        computed: {
            displayData : function() {
                if(this.search[0])
                {
                    var a = this.search[0];
                    return a;
                } else {
                    return this.search;
                }
                
            },
        },
        methods: {
            onChange : function(select){
                let e = this.select.name
                console.log(e);
                axios.get('/api/v1/user/search/' + e)
                .then((response) => {
                    this.search = response.data
                    console.log(response.data)
                })
            },
            resubmit() {
                this.edit = true;
            },
            upload() {
                this.edit = false;
                let existingObj = this;

                const config = {
                    headers: {
                        'content-type' : 'multipart/form-data'
                    }
                }

                let data = new FormData();
                data.append('id', this.displayData.id);
                data.append('cid', this.select.id);
                data.append('c', this.select.name);
                data.append('file', this.file);
                
                axios.post('/api/v1/user/upload',data, config)
                .then(function (res) {
                    existingObj.success = res.data.success;
                    window.location.reload();
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
            },
            downloads() {
                axios.get('/api/v1/user/download', {responseType: 'blob'})
                .then((response) => {
                
                    //var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
                    this.loops = response.data;
                    var fileLink = document.createElement('a')
                    fileLink.href = fileUrl;

                    fileLink.setAttribute('download', fileUrl )
                    document.body.appendChild(fileLink)

                    fileLink.click()
                });
            }
        },

        created() {
            axios.get('/api/v1/user/download')
            .then(response => ( this.presets = response.data ) );

            // populate data into v-select option
            axios.get('api/v1/submissiontype')
            .then( response => ( 
                this.items = response.data 
            ) );
        },

    }
</script>