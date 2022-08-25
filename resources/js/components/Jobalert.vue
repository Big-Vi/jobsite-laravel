<template>
  <div>
    <div class='row'>
    <div class='searchform col m12 s12 center-align'>
        <div class='input-field col m4 s12'>
            <input
              id='keyword'
              type="text"
              name='keyword'>
            <label for="keyword">Enter keyword</label>
        </div>  
        <div class="input-field col s12 m4">
          <select @change='getCat($event)' id='category' name='category'>
            <option  value="" disabled selected='true'>Any classification</option>
            <option  :data-index='index'  v-for='(option, index) in category' :key='index'  :value='option.category'>
              <span >{{option.category}}</span>
            </option>
          </select>
          <input  hidden name='categoryindex' v-model='this.cat'>
          <select @change='getSub($event)' id='subcategory' name='subcategory' v-model='subcategory'>
            <option  selected='true' value="">Any sub classification</option>
              <option  :data-index='index' v-for='(option, index) in category[cat].subcategory' :key='index' :value='option'>
              {{option}}
            </option>
          </select>
          <input  hidden name='subcategoryindex' v-model='this.sub'>
        </div>
        <div class='input-field col m4 s12'>
            <input
              id='location'
              type="text"
              name='location'>
            <label for="location">Location</label>
        </div>
    </div>
    </div>
  </div>
</template>

<script>
import jobCategory from './category.json'; 
export default{
name : 'jobalert',
data() {
    return {
      category: jobCategory,
      subcategory: '',
      cat:100,
      sub:''
    };
  },
methods: {
getCat: function(e){
      if(e.target.options.selectedIndex > -1) {
            this.cat= e.target.options[e.target.options.selectedIndex].dataset.index;
            
        }
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