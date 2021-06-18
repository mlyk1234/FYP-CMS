import axios from "axios";

const state = {
    user: {}
};
const getters = {
    StateUser: state => state.user,
};
const actions = {
    // commit used by mutations
    getUser( {commit} ) {
        axios.get("/api/v1/user/current")
        .then( response => {
            commit( 'setUser', response.data );
        });
    },
    registerUser( {}, user ){
            axios
            .post("/api/v1/user/register", {
                name: user.name, 
                uniqueid: user.uniqueid,
                email: user.email, 
                password: user.password,
                role: user.role
            })
            .catch(error => {
                reject(error);
            })
            .then( response => {

                window.location.replace('/login');
                console.log( response.data );
            })
        
    },
    async loginUser( {commit}, user ){
        await axios
        .post("/api/v1/user/login", {
            email: user.email,
            password: user.password
        })
        .then( response => {
                //save token
                if(response.data!==1)
                {
                    localStorage.setItem('fyp_token', response.data.accessToken);
                    window.location.replace('/fyp');
                }

            console.log( response.data );
        })
        await commit('setUser', user.get('email','password'))
    },
    logoutUser() {
        // remove token upon logout
        localStorage.removeItem("fyp_token");
        window.location.replace("/login");
    },
};
const mutations = {
    setUser( state, data ) {
        state.user = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}