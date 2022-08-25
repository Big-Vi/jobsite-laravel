<template>
<div class='feat-arti-content'>
    <div v-for='propjob in propjobs.data' v-bind:key='propjob.id' class="feat-arti-card card">
      <div class='card-header'>
          <h3>{{propjob.title | trimdash}}</h3>
      </div>
      <div class='card-body'>
         <img class="card-icon" :src="`/storage/jobs/${propjob.title}/logo_images/${propjob.logo}`">
         <p v-html="$options.filters.truncate(propjob.description)"></p>
      </div>
    </div>
</div>
</template>
<script>
export default {
  name: "jobcard",
  props: ['job'],
  data() {
    return{
        propjobs: _.cloneDeep(this.job)
    }
        },
  filters: {
            trimdash(value) {
            let i = value.indexOf('-');
            if(i>1) {
                return value.substring(0,i)
            }else{
                return value
            }
        },
        truncate(value) {
            return value.substring(0, 2000);
      },
  },
};
</script>
<style>
.feat-arti-content{
    width: 100%;
    height: auto;
    display: flex;
    background-color: #292a2b;
    overflow-x: hidden;
}
.feat-arti-card {
  width: 30%;
  left: 0;
  position: relative;
  flex-shrink: 0;
  margin: 1.6667%;
  transition: left 1.5s;
}
.feat-arti-card h3{
  margin :0;
}
.card-carousel .card-icon {
    pointer-events: none;
    width: 80px;
    height: 50px;
    bottom: 0;
    right: 0;
    position: absolute;
}
@media only screen and (max-width: 1024px) {
.feat-arti-card {
  width: 40%;
  margin: 5%;
}
}
@media only screen and (max-width: 768px) {

}
@media only screen and (max-width: 420px) {
.feat-arti-card {
  width: 90%;
  margin: 5%;
}
}

</style>