<template>
  <div>
    <div class='row'>
    <div class='col m12 s12 center-align'>
        <div class="input-field col s12 m8">
          <select @change='getCat($event)' id='category' name='category' :value='this.category[this.cat].category'>
            <option  value="">Any classification</option>
            <option  :data-index='index'  v-for='(option, index) in category' :key='index'  :value='option.category'>
              <span >{{option.category}}</span>
            </option>
          </select>
          <input hidden  name='categoryindex' v-model='this.cat'>
          <select @change='getSub($event)' id='subcategory' name='subcategory' :value='this.category[this.cat].subcategory[this.sub]'>
            <option disable value="">Any sub classification</option>
              <option  :data-index='index' v-for='(option, index) in category[this.cat].subcategory' :key='index' :value='option'>
              {{option}}
            </option>
          </select>
          <input  hidden name='subcategoryindex' v-model='this.sub'>
        </div>
    </div>
    </div>
  </div>
</template>

<script>
import jobCategory from './category.json';
export default{
props: ['cate'],
name : 'editjobcategory',
components: {},
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