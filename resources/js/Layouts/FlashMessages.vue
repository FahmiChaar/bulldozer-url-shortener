<template>
  <span></span>
</template>

<script>
export default {
  watch: {
    '$page.props.flash': {
      handler() {
        if (this.$page.props.flash && this.$page.props.flash.length) {
          const errorStatus = this.$page.props.flash[0].level == 'danger' ? 'error' : this.$page.props.flash[0].level
          let messages = ''
          for (let message of this.$page.props.flash) {
            messages += message.message + '\n'
          }
          this.$toast[errorStatus](messages)
        }
      },
      deep: true,
    },
    '$page.props.errors': {
      handler() {
        if (this.$page.props.errors && Object.keys(this.$page.props.errors).length) {
          let messages = ''
          for (let key in this.$page.props.errors) {
            messages += this.$page.props.errors[key] + '\n'
          }
          this.$toast.error(messages)
        }
      },
      deep: true,
    },
  },
}
</script>
