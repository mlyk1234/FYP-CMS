<template>
<div id="app">
  <v-app>
    <v-content>
      <v-container fluid ma-0 pa-0 fill-height>
        <v-layout>
            <v-card-text>
                <v-card height="auto">
            <div class="content">
                <v-divider></v-divider><v-divider></v-divider>
                  <v-carousel height="100%" hide-delimiters>
                    <v-carousel-item
                    v-for="(item,i) in items"
                    :key="i"
                    :src="item.src"
                    reverse-transition="fade-transition"
                    transition="fade-transition"
                    >
                <div class="title m-b-md">

                    <v-container class="lighten-5">
                    <div align="center" >
                        <v-sheet
                        style="position: absolute;top:0;left:0;background-color:white;opacity:0.5;"
                        elevation="1"
                        height="100%"
                        width="100%"
                      ></v-sheet>
                        <v-img src="/images/fyp-icon.png" width="850px"></v-img></div>
                    </v-container>
                    <v-card tile>
                    <v-card-text>version release: 1.0 initial (2021)</v-card-text>
                    </v-card>
                <v-card tile>
                <div>Portal</div>
                <div class="links">
                    <a @click="login()" style="color:#1976d2">Login</a>
                    <a @click="register()" style="color:#1976d2">Register</a>
                </div>
                </v-card>
                <v-card class="mt-2">
                <div class="content">
                <div>External Portal</div>
                <div class="links">
                    <a href="https://www.unimas.my/">Unimas</a>
                    <a href="https://www.fcsit.unimas.my/?fbclid=IwAR2KnZFPNOP_TmgK08NqAAZC4YJg9na0PA0VCAB64JOsVJlhdM5fkDQ1u3E">FCSIT</a>
                    <a href="https://www.unimas.my/">Research</a>
                    <a href="https://www.facebook.com/unimasofficial/">News</a>
                    <a href="https://play.google.com/store/apps/details?id=my.unimas.earlyedition&hl=en">Unimas Now</a>
                    <a href="">GitHub</a>
                </div>
                    </div>
                </v-card>
                </div>
                </v-carousel-item>
  </v-carousel>

                <v-divider></v-divider>

            </div>
                </v-card>  
                              

            </v-card-text>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</div>
</template>

<script>
  export default {
    data () {
      return {
        items: [
          {
            src: '/images/DmfB7DQXsAAOAVs2.jpg',
          },
          {
            src: '/images/Art_Timo_Kuilder_Geometric_Illustrations_Zwartekoffie_22.gif',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
        ],
      }
    },
    methods: {
      login(){
        document.location.href="/login";
      },
      register(){
        document.location.href="/register";
      }
    },
  }
</script>