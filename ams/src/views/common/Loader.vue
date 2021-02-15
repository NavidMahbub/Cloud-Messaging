<template>
    <div class="loaderOuter">
        <div class="loader">
            <img  src="../../static/loading3.gif" alt="">
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
    .loaderOuter{
        position: fixed;
        z-index: 1444;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(255,255,255);
        background-color: rgba(255,255,255,.7);
    }
    .loader{
        margin-left:calc(50% - 30px);
        margin-top:200px;
    }
    .loader img{
        height:60px;width:60px
    }
</style>
