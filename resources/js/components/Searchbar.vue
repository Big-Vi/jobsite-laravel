<template>
  <div>
    <div class='row'>
    <div class='searchform col m12 s12 center-align'>
        <div class='input-field col m3 s12'>
            <input
              id='keyword'
              type="text" 
              @keyup.enter="submit"
              v-model="form.keywords">
            <label for="keyword">Enter keyword</label>
        </div>  
        <div class="input-field col s12 m3">
          <select @change='getSub($event)' v-model='form.category'>
            <option  disabled value="">Any classification</option>
            <option  :data-index='index' ref='cat' class='sub'  v-for='(option, index) in category' :key='index'  :value='option.category'>
              <span >{{option.category}}</span>
            </option>
          </select>
          <select v-model='form.subcategory'>
            <option selected='true' value="">Any sub classification</option>
              <option  v-for='(option, index) in category[sub].subcategory' :key='index' :value='option'>
              {{option}}
            </option>
          </select>
        </div>
        <div class='input-field col m3 s12'>
            <input
              id='location'
              type="text"
              v-model="form.location">
            <label for="location">Location</label>
        </div> 
        <div class='input-field col m3 s12' style='margin-top:1.5em;'>
            <button id='search' v-on:click='submit()' type='submit' class='find s12 m2 btn btn-small waves-effect waves-light black'>Find</button>
        </div>
        <div class='more-option'>
          <Span>More Options</span><i class="fas fa-chevron-down"></i><i class="fas fa-chevron-up"></i>
        </div>
    </div>
    </div>
    <div class='row'>
      <div class='more-search-form col m12 s12 center-align'>
        <div class="input-field col s12 m3">
          <select v-model='form.worktype'>
            <option value="">Any Work Type</option>
            <option v-for='(option, index) in options.worktype' :key='index' :value='option.value'>
              {{option.text}}
            </option>
          </select>
        </div>
        <div class='range-slider col s12 m4'>
          <span>Payment Range</span>
           <veeno 
            v-model="form.sliderValue"
            :handles="36000"
            :range = "{ 'min': 0, 'max': 200000 }"
            >
          {{ form.sliderValue }}
          </veeno>
        </div>
        <div class="input-field col s12 m3">
          <select v-model='form.timeposted'>
            <option value="">Time Posted</option>
            <option v-for='(option, index) in options.timeposted' :key='index' :value='option.value'>
              {{option.text}}
            </option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import veeno from 'veeno';
import jobCategory from './category.json';
import 'veeno/node_modules/nouislider/distribute/nouislider.min.css';  
export default{
name : 'searchbar',
components: {veeno},
data() {
    return {
      category: jobCategory,
      sub:100,
      form: {
        keywords: '',
        category: '',
        subcategory: '',
        location: '',
        worktype: '',
        timeposted: '',
        sliderValue :130,
      },
      options: {
        worktype: [
          { value: 'Full time', text: "Full Time"},
          { value: 'Part Time', text: "Part Time"},
          { value: 'Contract/Temp', text: "Contract/Temp"},
          { value: 'Casual/Vacation', text: "Casual/Vacation"}
        ],
        timeposted: [
          { value: '1', text: "Today"},
          { value: '3', text: "3 Days Ago"},
          { value: '7', text: "Week Ago"},
          { value: '30', text: "Last 30 Days"}
        ]
      }
    };
  },
methods: {
    submit: function() {
      
      this.$emit("inputData", this.form); 
      document.getElementById("home-hide").style.display='none'; 
      
    },
    getSub: function(e){
      if(e.target.options.selectedIndex > -1) {
            this.sub= e.target.options[e.target.options.selectedIndex].dataset.index;
        }
    }
  },
}

</script>

<style scoped>
.find{
  position: relative;
}

</style>