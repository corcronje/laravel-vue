import axios from "axios";

const state = {
  user: null,
};

const getters = {
  user: (state) => state.user,
  isAuthenticated: (state) => !!state.user,
};

const actions = {
  async register({ commit }, credentials) {
    let response = await axios.post("register", credentials);
    commit("SET_USER", response.data.user);
    localStorage.setItem("token", response.data.user.token);
  },
  async login({ commit }, credentials) {
    let response = await axios.post("login", credentials);
    commit("SET_USER", response.data.user);
    localStorage.setItem("token", response.data.user.token);
  },
  async logout({ commit }) {
    await axios.post("logout", null, {
      headers: {
        Authorization: "Bearer " + this.getters.user.token,
      },
    });
    commit("SET_USER", null);
    localStorage.removeItem("token");
  },
  async loadUser({ commit }) {
    let response = await axios.get("user", {
      headers: {
        Authorization: "Bearer " + this.getters.user.token,
      },
    });
    commit("SET_USER", {
      name: response.data.user.name,
      email: response.data.user.email,
      token: this.getters.user.token,
    });
  },
};

const mutations = {
  SET_USER(state, user) {
    state.user = user;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
