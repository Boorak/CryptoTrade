<template>
    <div class="panel ng-bg-dark">
        <div class="panel-heading">
            <h6 class="panel-title">
                {{title}}
                <a class="heading-elements-toggle">
                    <i class="icon-more"></i>
                </a>
            </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse"></a>
                    </li>
                    <li>
                        <a data-action="close"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <slot name="body"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "panel",
        props: ['title'],
    }
</script>

<style scoped>

</style>