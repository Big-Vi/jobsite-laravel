<template>
  <div>
    <div class='row'>
    <div class='searchform col m12 s12 center-align'>
        <div class='input-field col m4 s12'>
            <input
              id='keyword'
              type="text"
              name='keyword'
              :value='this.cate.keyword'>
            <label for="keyword">Enter keyword</label>
        </div>  
        <div class="input-field col s12 m4">
          <select @change='getCat($event)' id='category' name='category' :value='this.category[this.cat].category'>
            <option  value="" disabled selected='true'>Any classification</option>
            <option  :data-index='index'  v-for='(option, index) in category' :key='index'  :value='option.category'>
              <span >{{option.category}}</span>
            </option>
          </select>
          <input  hidden name='categoryindex' v-model='this.cat'>
          <select @change='getSub($event)' id='subcategory' name='subcategory' :value='this.category[this.cat].subcategory[this.sub]'>
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
              name='location'
              :value='this.cate.location'>
            <label for="location">Location</label>
        </div>
    </div>
    </div>
  </div>
</template>

<script>
import jobCategory from './category.json'; 
export default{
props: ['cate'],
name : 'jobalertedit',
data() {
    return {
      category: jobCategory,
      cat:this.cate.categoryindex,
      sub:this.cate.subcategoryindex
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