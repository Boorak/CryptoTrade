<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    window.Event = new Vue();

    window.notify = function (type, msg) {
        new Noty({
            type: type,
            layout: 'bottomRight',
            theme: 'mint',
            text: msg,
            timeout: 3000,
        }).show();
    }

    export default {}

</script>
