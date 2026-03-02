export class Ajax {
    constructor(data, dataType, endpoint) {
        this.data = data
        this.dataType = dataType
        this.endpoint = this.endpoint? endpoint : js_ajax_object.ajax_url
    }

    sendRequest(success = false, before = false){
        $.ajax({
            url : this.endpoint,
            data : this.data,
            dataType: this.dataType? this.dataType : '',
            type : 'POST',
            beforeSend : function (xhr) {
                before? before(): before
            },
            success : function (data) {
                success? success(data): success
            }
        })
    }
}