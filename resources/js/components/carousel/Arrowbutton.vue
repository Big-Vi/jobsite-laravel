<template>
  <button class="arrowbtn" @click="onClick">
    <img
      class="icon"
      :src="require(`../../../assets/svg/${arrowType}.svg`)" 
      :alt="arrowType + ' arrow'"
    >
  </button>
</template> 
<script>
export default {
  name: "arrowbutton",
  props: { arrowType: String, onClick: Function },
  
};
</script>
<style>
.arrowbtn { 
  height: 90px;
  border: none;
  background: transparent;
  cursor: pointer;
  opacity: 0.5;
}
.feat-card-nav{
  float: right;
}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (max-width: 768px) {
  
}

.arrowbtn:focus {
  outline: none;
}

.arrowbtn:hover {
  opacity: 0.7;
}

.arrowbtn:disabled {
  opacity: 0.2;
  cursor: default;
}

.arrowbtn .icon {
  height: 60px;
  width: auto;
}
</style>