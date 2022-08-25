<template>
 <div>
   <div class='feat-card-nav'>
     <arrowbutton v-if="this.jobs.data.length>3"
        arrowType="left"
        :onClick="showPrevElement"
        :disabled='maxLeft'
      />
      <arrowbutton v-if="this.jobs.data.length>3"
        arrowType="right"
        :onClick="showNextElement"
        :disabled='maxRight'
      />
   </div> 
   <jobcard
    class="card-carousel"
    :job='jobs'
   />
 </div>
</template>
<script>
export default {
  name: "carousel",
  props: ['jobs','job'],
  data() {
    return {
      currentElementIndex: 0,
      cardvalue: 0,
      maxRight: false,
      maxLeft: true
    };
  },
  methods: {
      showPrevElement(){
        this.maxRight = false;
        let cards = document.getElementsByClassName('card');
        if(cards[cards.length-1].offsetLeft<(window.innerWidth/10)){
           this.maxLeft = true;
        }
        if (window.innerWidth < 1050 && window.innerWidth > 420) {
              this.cardvalue -= 50;
          } else if (window.innerWidth < 420){
              this.cardvalue -= 100;
          }
          else{
              this.cardvalue -= 33.334;
          }
          for(var i=0; i< cards.length; i++){
              cards[i].style.left = "-" + this.cardvalue +"%";
            }
      },
      showNextElement(){
        let cards = document.getElementsByClassName('card');
        console.log(cards[cards.length-1].offsetLeft)

        let right = cards[cards.length-1].offsetLeft-window.innerWidth;
        console.log(window.innerWidth)
        console.log(right)
        if(right<(window.innerWidth/10)){
           this.maxRight = true;
        }
        if (window.innerWidth < 1050 && window.innerWidth > 420) {
              this.cardvalue += 50;
          } else if (window.innerWidth < 420) {
              this.cardvalue += 100;
          }
          else{
              this.cardvalue += 33.334; 
          }
          for(var i=0; i< cards.length; i++){
              cards[i].style.left = "-" + this.cardvalue +"%";
            }
      }
  },
  watch: { 
    cardvalue: function() {
        if(this.cardvalue == 0) {
            this.maxLeft = true;
        }else{
            this.maxLeft = false;
        }
    }
  }
};
</script>
<style>


</style>