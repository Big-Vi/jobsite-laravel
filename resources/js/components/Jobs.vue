<template>
<div>
     <div class='searchbar text-center'> 
            <searchbar @inputData="setKeyword"></searchbar>
    </div>
    <div class='container'>
        <spin v-if='spin'></spin>
    </div>
    <div v-if='content' class='container'>
        <div v-if='jobs.data[0]'>
            <div  class='jobs m10 l8' v-for='job in jobs.data' v-bind:key='job.id'>
            <div class='row'>
                <div class='col m8 s8'>
                    <a :href='`/jobseeker/jobs/${job.id}`'><h5>{{job.title | trimdash}}</h5></a>
                </div>
                <div class='col m4 s4 right-align'>
                    <p>{{job.created_at | moment("from", "now", true)}}</p>
                </div>
                <div class='col s10 m10'>
                    <p>{{job.location}}</p>
                    <p>{{job.worktype}}</p>
                    <p>{{job.pitch}}</p>
                </div>
                <div class='col s2 m2'>
                    <img class='emp-logo' :src="`/storage/jobs/${job.title}/logo_images/${job.logo}`">
                </div>
            </div>  
            </div>
        </div>
        <div v-else class='col s10 m8 l8 offset-m2 center-align'>
            <p>No jobs yet posted. </p>
        </div>
      <pagination  class='justify-content-center text-center col-md-10 mx-auto mt-3' :data="jobs" @pagination-change-page="getFiltered"></pagination>  
    </div>
</div>
</template>
 
<script>
import Spin from 'vue-loading-spinner/src/components/Stretch';
    export default {
        name: 'jobs',
        components: {
            Spin
            },
        mounted() { 
            console.log('Component mounted.')
        },
        data() {
            return {
                spin: false,
                content: false,
                jobs: null,
                fav:'',
                form: {
                    keywords: '',
                    category: '',
                    subcategory: '',
                    location: '',
                    worktype: '',
                    timeposted: '',
                    sliderValue : ''
                    }
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
            return value.substring(0, 500);
      },
  },
        methods: {
        setKeyword(variable) {
            this.spin = true;
            this.content = false;
            this.form.keywords = variable.keywords;
            this.form.category = variable.category;
            this.form.subcategory = variable.subcategory;
            this.form.location = variable.location;
            this.form.worktype = variable.worktype;
            this.form.timeposted = variable.timeposted;
            this.form.sliderValue = variable.sliderValue;
            this.getFiltered();
        },
        getFiltered(page) {
            if (typeof page === 'undefined') {
                    page = 1;
                }
            setTimeout(() => {
                axios.get("/api/search?page="+ page, {
                    params: {
                    keywords: this.form.keywords,
                    category: this.form.category,
                    subcategory: this.form.subcategory,
                    location: this.form.location,
                    worktype: this.form.worktype,
                    timeposted: this.form.timeposted,
                    sliderValue: this.form.sliderValue
                    }
                })
                .then(data => {
                        this.spin = false;
                        this.jobs = data.data;
                        this.content = true;
                    });
            }, 1000)
            
        }
    
        }
    }
</script>
<style scoped>

</style>