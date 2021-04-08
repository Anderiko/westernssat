<template>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 999999;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="notif">
            <div class="toast-header">
                <img :src="'images/westernssat.png'" class="rounded me-2" width="20" height="20" alt="">
                <strong class="me-auto">{{ this.$store.state.toast.title }}</strong>
                <small class="text-muted">WESTERN'SSAT</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ this.$store.state.toast.content }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Toast',
    mounted() {
        let notif = document.getElementById('notif')

        let toast = new bootstrap.Toast(notif, {delay: 3000})

        toast.show()

        notif.addEventListener('hide.bs.toast', event => {
            this.$store.dispatch('dismissToast')
        })
    }
}
</script>

<style scoped>

</style>
