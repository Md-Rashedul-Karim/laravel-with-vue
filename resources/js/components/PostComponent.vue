<template>
    <div>
      <h1>Posts</h1>
      <!-- List Posts -->
      <ul>
        <li >

          <button >Edit</button>
          <button>Delete</button>
        </li>
      </ul>
      <!-- Form to Add/Edit Posts -->
      <form @submit.prevent="savePost">
      <input v-model="form.title" placeholder="Title" required>
      <textarea v-model="form.content" placeholder="Content" required></textarea>
      <button type="submit">Save</button>
    </form>
    </div>
  </template>
  <script>
import axios from 'axios';

export default {
  data() {
    return {
      posts: [],
      form: {
        id: null,
        title: '',
        content: ''
      }
    };
  },
  mounted() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      axios.get('/posts').then(response => {
        this.posts = response.data;
      });
    },
    savePost() {
      let endpoint = this.form.id ? '/posts/${this.form.id}' : '/posts';
      let method = this.form.id ? 'put' : 'post';

      axios[method](endpoint, this.form).then(() => {
        this.fetchPosts();
        this.resetForm();
      });
    },

    resetForm() {
      this.form = {
        id: null,
        title: '',
        content: ''
      };
    }
  }
};
</script>
