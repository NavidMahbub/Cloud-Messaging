<template>
    <div>
        <downloadExcel :data="dataForExcel">
            <button>Excel</button>
        </downloadExcel>
    </div>
</template>

<script>
import downloadExcel from 'vue-json-excel'
export default {
    components:{
        downloadExcel
    },
    data: () => {
    return {
      dataForExcel: [
        { colA: "Hello", colB: "World" },
        {
          colA: "Multi-line",
          /* Multi-line value: */
          colB:
            "This is a long paragraph\nwith multiple lines\nthat should show in a single cell."
        },
        { colA: "Another", colB: "Regular cell" },
        { colA: "Another", colB: "Regular cell" },
      ]
    };
  }
  
}
</script>


<style>
 .actn{
     margin-left: 10px;
     cursor: pointer;
 }
 .contct{
     padding-bottom: 10px;
     padding-top: 10px
 }
 .contct-b{
     margin-bottom: 10px;
     margin-top: 10px
 }
 .load{
     margin-left: 50%;
 }
</style>
