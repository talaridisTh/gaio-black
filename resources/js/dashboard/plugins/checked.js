function checked() {
    return {

        selectall: false,

        selectAllCheckboxes() {
            this.selectall = !this.selectall

            checkboxes = document.querySelectorAll('[id^=checkbox]');
            [...checkboxes].map((el) => {
                el.checked = this.selectall;
            })
        },

        checkedMainInput() {
            let checkedAll = [],
                checkboxes = document.querySelectorAll('[id^=checkbox]');
            [...checkboxes].map((el) => {
                checkedAll.push(el.checked)

            })

            checkedAll.every(Boolean) ? this.$refs.mainInput.checked = true : this.$refs.mainInput.checked = false;
        }
    }
}


