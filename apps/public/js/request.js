const Request = {
    noPending: false,
    requestHidden: function(){
        this.noPending = true;
        return this;
    },
    ajax : function(url, param, succFunc, doneFunc){
        if(typeof param == 'undefined'){
            param = {};
        }
        if(typeof succFunc == 'undefined' && typeof param == 'function'){
            succFunc = param;
            param = {};
        }
        const self = this;
        const config = {
            url : url,
            type : 'POST',
            dataType : 'json',
            data : param,
            beforeSend : function(){
                !self.noPending && self.showPendingRequest();
            },
            success : function(result){
                if(typeof succFunc == 'function'){
                    succFunc(result);
                }
            },
            error : function(error){
                console.log(error.responseText);
            }
        }
        if(param instanceof FormData){
            config.cache = false;
            config.processData = false;
            config.contentType = false;
        }
        const ajaxResult = $.ajax(config);
        ajaxResult.always(function(xhr){
            if(typeof doneFunc == 'function'){
                doneFunc(xhr);
            }
            !self.noPending && self.hidePendingRequest();
            self.noPending = false;
        });
        return ajaxResult;
    },
    showPendingRequest : function(){
        $(".pending-request").addClass("show");
    },
    hidePendingRequest : function(){
        $(".pending-request").removeClass("show");
    }
}
