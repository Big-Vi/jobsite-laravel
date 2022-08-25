<template>
    <div>
      <h2>Jobs created</h2>
      <div v-if="propjobs.length==0">No job to display</div>
      <div v-for='(propjob, index) in propjobs' v-bind:key='propjob.id'>
        <div class="row">
          <div class="col s12 m10 l10 offset-l1">
            <div class="card darken-1">
              <div class="card-content">
                <span class="card-title"><a :href="`/employer/job/${propjob.id}`">{{propjob.title | trimdash}}</a></span>
                <p>{{propjob.pitch}}</p>
              </div>
              <div class="card-action">
                <a class='btn btn-secondary' :href="`/employer/job/${propjob.id}/edit`">Edit</a>
              <a class='btn btn-secondary' v-on:click='removeJob(index)'>Delete</a>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>    
     
</template>

<script type="text/javascript">
export default{
name : 'employerindex',
props: ['jobs', 'employer', 'auth_user'],
data() {
    return{
        propjobs: this.jobs
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
            return value.substring(0, 2500);
      },
  },
methods: {
    removeJob(index) {
        let id = this.propjobs[index].id;
        axios.delete('/api/jobs/'+id).
        then(response => { 
                console.log(response)
            })
        this.propjobs.splice(index, 1);

    }
}
}
</script>