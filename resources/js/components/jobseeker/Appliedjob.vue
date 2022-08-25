<template>
  <div>
    <div v-if="appliedjobs[0]">
      <div v-for="job in jobs" v-bind:key="job.id">
        <ul>
          <li style='list-style-type:disc;'>
            <a :href="`/jobseeker/jobs/${job.id}`">{{job.title | trimdash}}</a>
          </li>
        </ul>
        <br>
      </div>
    </div>
    <div v-else>
      <p>You haven't applied for any jobs yet.</p>
    </div>
  </div>
</template>

<script>
export default {
  props: ['appliedjobs'],
  data() {
    return {
      jobs: this.appliedjobs,
    };
  },
  filters: {
    trimdash(value) {
      let i = value.indexOf('-');
      if (i > 1) {
        return value.substring(0, i);
      } else {
        return value;
      }
    },
  },
};
</script>