import{aq as u,j as p,s as l,S as f}from"./vendor-staging.js";const w=u(),x=p("UiStore",{state:()=>({loading:!1})}),o=(e,t,n)=>{const s=window.gpos.prefix,i=window.gpos.nonce,c=`${window.gpos.ajaxurl}?action=${s}_${t}&_wpnonce=${i}`,{loading:r}=l(x(w));return window.jQuery.ajax({url:c,type:e,dataType:"json",contentType:"application/json",accept:"application/json",data:n?JSON.stringify(n):!1,beforeSend:()=>{r.value=!0},success:()=>{r.value=!1},error:a=>{r.value=!1,a.statusText!=="abort"&&f.fire({text:a.responseJSON.error_message,icon:"error",confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#C81E1E"})}})},T={get(e,t){return o("GET",e,t)},post(e,t){return o("POST",e,t)},delete(e,t){return o("DELETE",e,t)},put(e,t){return o("PUT",e,t)},patch(e,t){return o("PATCH",e,t)}};export{T as a,w as p,x as u};
