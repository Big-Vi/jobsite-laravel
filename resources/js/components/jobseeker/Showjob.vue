<template>
    <div> 
        <div class="container">
            <div class="row justify-content-center">
                <div class="col m8 l10 s12 offset-l1">
                <div class="job-seeker-showjob">
                        <div>
                            <h3>{{job.title | trimdash}}</h3>
                            <p v-html="job.description"></p>
                            <a class='btn btn-primary black' :href="`/jobseeker/jobs/${job.id}/apply`">Apply</a>
                            <a class='btn btn-primary black' :href='`/jobseeker/jobs/${job.id}/send`'>Send job</a>
                        </div>      
                    </div>  <br>          
                </div>
            </div>
        </div>       
    </div>
</template>

<script>
export default{
props: ['job'],
data() {
    return{
        
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
}
</script>