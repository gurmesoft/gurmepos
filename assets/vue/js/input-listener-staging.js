import{s as f,o as u,c,a,g as h,u as l,T as z,f as A,t as _,F as k,q as C,D as I,l as D,x,aj as Q,n as w,ac as R,ak as H,d as S,al as G,w as $,m as F,am as M,p as T,b as U,I as J,an as O,_ as K,ao as g,a2 as P,ap as W}from"./vendor-staging.js";import{u as m}from"./CheckoutStore-staging.js";import{_ as X}from"./_plugin-vue_export-helper-staging.js";import{u as Y,p as L}from"./ajax-staging.js";let b=!1;const E=window.jQuery,V=()=>{b&&b.unmount(),b=window.gposCreateCheckoutApplication()};E(document).ready(V);E(document.body).on("updated_checkout",V);E(document).on("give_gateway_loaded",V);setInterval(()=>{(typeof b!="object"||!b.mount)&&V()},1e3);const Z={class:"bg-yellow-100 text-yellow-700 p-3 flex flex-col rounded gap-2"},ee={class:"flex items-center gap-2 text-lg font-semibold"},te={key:0},ne=a("th",null,null,-1),se={class:"hidden md:table-cell"},ae=a("th",{class:"hidden md:table-cell"}," Cvc ",-1),oe=a("th",{class:"hidden md:table-cell"}," 3ds ",-1),re=a("th",null,null,-1),le=["src"],de={class:"hidden md:table-cell"},ie={class:"hidden md:table-cell"},ue={class:"hidden md:table-cell"},Ke={__name:"TestMode",setup(d){const s=m(),{card:n}=f(s),{assetsUrl:t,gateway:r}=s,o=e=>{n.value.bin=e.bin,n.value.expiry_month=e.expiry_month,n.value.expiry_year=e.expiry_year,n.value.expiry=`${e.expiry_month} / ${e.expiry_year}`,n.value.cvv=e.cvv};return(e,i)=>(u(),c("div",Z,[a("div",ee,[h(l(z),{class:"w-6"}),A(_(e.$t("test_mode_title")),1)]),a("div",null,_(e.$t("test_mode_checkout_desc")),1),l(r).test_cards.length>0?(u(),c("table",te,[a("tr",null,[ne,a("th",null,_(e.$t("card_bin")),1),a("th",se,_(e.$t("month_year")),1),ae,oe,re]),a("tbody",null,[(u(!0),c(k,null,C(l(r).test_cards,(p,y)=>(u(),c("tr",{key:y,class:"!border-b !border-yellow-700"},[a("td",null,[a("img",{class:"w-8",src:`${l(t)}/images/card/${p.brand}.svg`},null,8,le)]),a("td",null,_(p.bin),1),a("td",de,_(p.expiry_month)+"/"+_(p.expiry_year),1),a("td",ie,_(p.cvv),1),a("td",ue,_(p.secure),1),a("td",null,[h(l(I),{class:"w-6 cursor-pointer",onClick:Qe=>o(p)},null,8,["onClick"])])]))),128))])])):D("",!0)]))}},ce={class:"inline-flex relative !rounded-l items-center justify-start text-sm !bg-white !w-12 !min-w-max"},pe=["placeholder"],Pe={__name:"HolderName",setup(d){const s=x(!1);return(n,t)=>(u(),c("div",{class:w(`flex w-full border !rounded ${s.value?"border-blue-700":"border-gray-300"}`)},[a("span",ce,[h(l(Q),{class:"w-6 h-6 mx-3","aria-hidden":"true"})]),a("input",{id:"gpos-card-holder-name",type:"text",placeholder:n.$t("name_on_card"),onFocus:t[0]||(t[0]=r=>s.value=!s.value),onFocusout:t[1]||(t[1]=r=>s.value=!s.value)},null,40,pe)],2))}},_e={},ve={class:"dot-spinner mx-3"},me=R('<div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div>',8),ye=[me];function fe(d,s){return u(),c("div",ve,ye)}const he=X(_e,[["render",fe]]),xe={class:"inline-flex relative !rounded-l items-center justify-start text-sm !bg-white !w-12 !min-w-max"},ge=["src"],We={__name:"BinNumber",setup(d){const s=x(!1),{loading:n}=f(Y()),t=m(),{card:r}=f(t),{assetsUrl:o}=t;return(e,i)=>{const p=H("cardformat");return u(),c("div",{class:w(`flex w-full border !rounded ${s.value?"border-blue-700":"border-gray-300"}`)},[a("span",xe,[l(n)?(u(),S(he,{key:0,class:"w-6 h-6"})):["visa","mastercard","amex"].includes(l(r).brand)?(u(),c("img",{key:1,class:"w-12 h-12 !m-0",src:`${l(o)}/images/card/${l(r).brand}.svg`},null,8,ge)):(u(),S(l(G),{key:2,class:"w-6 h-6 mx-3","aria-hidden":"true"}))]),$(a("input",{id:"gpos-card-bin","onUpdate:modelValue":i[0]||(i[0]=y=>l(r).bin=y),class:"",placeholder:"•••• •••• •••• ••••",inputmode:"numeric",type:"tel",autocomplete:"cc-number",onFocus:i[1]||(i[1]=y=>s.value=!s.value),onFocusout:i[2]||(i[2]=y=>s.value=!s.value)},null,544),[[F,l(r).bin],[p,void 0,"formatCardNumber"]])],2)}}},$e={class:"inline-flex relative !rounded-l items-center justify-center text-sm !bg-white !w-12 !min-w-max"},be={class:"flex w-full"},we={value:""},ke=["value","textContent"],Ce={value:""},Fe=["value","textContent"],Ve={__name:"Select",setup(d){const s=m(),{card:n}=f(s),t=x(!1);return(r,o)=>(u(),c("div",{class:w(`flex w-full border !rounded ${t.value?"border-blue-700":"border-gray-300"}`)},[a("span",$e,[h(l(M),{class:"w-6 h-6 mx-3","aria-hidden":"true"})]),a("div",be,[$(a("select",{id:"gpos-card-expiry-month","onUpdate:modelValue":o[0]||(o[0]=e=>l(n).expiry_month=e),autocomplete:"cc-exp-month",class:"!border-0 !rounded-r !bg-white !m-0 !p-3 !focus:ring-0 !outline-0 !focus:ring-offset-0 !w-1/2",onFocus:o[1]||(o[1]=e=>t.value=!t.value),onFocusout:o[2]||(o[2]=e=>t.value=!t.value)},[a("option",we,_(r.$t("mm")),1),(u(),c(k,null,C(["01","02","03","04","05","06","07","08","09","10","11","12"],e=>a("option",{key:e,value:e,textContent:_(e)},null,8,ke)),64))],544),[[T,l(n).expiry_month]]),$(a("select",{id:"gpos-card-expiry-year","onUpdate:modelValue":o[3]||(o[3]=e=>l(n).expiry_year=e),autocomplete:"cc-exp-year",class:"!border-0 !rounded-r !bg-white !m-0 !p-3 !focus:ring-0 !outline-0 !focus:ring-offset-0 !w-1/2",onFocus:o[4]||(o[4]=e=>t.value=!t.value),onFocusout:o[5]||(o[5]=e=>t.value=!t.value)},[a("option",Ce,_(r.$t("yy")),1),(u(),c(k,null,C(["2023","2024","2025","2026","2027","2028","2029","2030","2031","2032","2033"],e=>a("option",{key:e,value:e,textContent:_(e)},null,8,Fe)),64))],544),[[T,l(n).expiry_year]])])],2))}},Be={class:"inline-flex relative !rounded-l items-center justify-center text-sm !bg-white !w-12 !min-w-max"},Se=["placeholder"],je=["value"],Ee=["value"],Te={__name:"Text",setup(d){const{card:s}=f(m()),n=x(!1),t=U(()=>{var o,e;return(e=(o=s.value.expiry)==null?void 0:o.replaceAll(/\s/g,""))==null?void 0:e.split("/")[0]}),r=U(()=>{var o,e,i;return(i=(e=(o=s.value.expiry)==null?void 0:o.replaceAll(/\s/g,""))==null?void 0:e.split("/")[1])==null?void 0:i.slice(-2)});return(o,e)=>{const i=H("cardformat");return u(),c("div",{class:w(`flex w-full border !rounded ${n.value?"border-blue-700":"border-gray-300"}`)},[a("span",Be,[h(l(M),{class:"w-6 h-6","aria-hidden":"true"})]),$(a("input",{id:"gpos-card-expiry","onUpdate:modelValue":e[0]||(e[0]=p=>l(s).expiry=p),placeholder:o.$t("mmyy"),inputmode:"numeric",type:"tel",autocomplete:"cc-exp",onFocus:e[1]||(e[1]=p=>n.value=!n.value),onFocusout:e[2]||(e[2]=p=>n.value=!n.value)},null,40,Se),[[F,l(s).expiry],[i,void 0,"formatCardExpiry"]]),a("input",{id:"gpos-card-expiry-month",type:"hidden",value:t.value},null,8,je),a("input",{id:"gpos-card-expiry-year",type:"hidden",value:r.value},null,8,Ee)],2)}}},Xe={__name:"Expiry",setup(d){const{formSettings:s}=m(),n=s.expiry_style=="select"?Ve:Te;return(t,r)=>(u(),S(J(l(n))))}},Ue={key:0,class:"absolute bottom-12 -right-2 z-50 p-4 bg-white border-gray-200 border rounded-lg shadow-md w-max gpos-cvv-tooltip"},Ne=["innerHTML"],Ae={class:"inline-flex relative !rounded-l items-center justify-center text-sm !bg-white !w-12 !min-w-max"},Ye={__name:"Cvc",setup(d){const s=m(),{card:n}=f(s),t=x(!1),r=x(!1);return(o,e)=>(u(),c("div",{class:w(`relative flex w-full border !rounded ${t.value?"border-blue-700":"border-gray-300"}`)},[r.value?(u(),c("div",Ue,[a("div",{innerHTML:o.$t("cvv_helper")},null,8,Ne)])):D("",!0),a("span",Ae,[h(l(O),{class:"w-6 h-6","aria-hidden":"true"})]),$(a("input",{id:"gpos-card-cvv","onUpdate:modelValue":e[0]||(e[0]=i=>l(n).cvv=i),placeholder:"CVC",inputmode:"numeric",type:"tel",autocomplete:"cc-csc",onFocus:e[1]||(e[1]=i=>t.value=!t.value),onFocusout:e[2]||(e[2]=i=>t.value=!t.value)},null,544),[[F,l(n).cvv]]),a("span",{class:"inline-flex relative !rounded-r z-10 items-center justify-center text-sm !bg-white !w-12 !min-w-max",onMouseover:e[3]||(e[3]=i=>r.value=!r.value),onMouseleave:e[4]||(e[4]=i=>r.value=!r.value)},[h(l(K),{class:"w-5 h-5","aria-hidden":"true"})],32)],2))}},De={class:"hidden"},He=["id","onUpdate:modelValue"],Ze={__name:"HiddenCardData",setup(d){const{card:s}=f(m());return(n,t)=>(u(),c("div",De,[(u(),c(k,null,C(["type","brand","family","bank_name","country"],r=>$(a("input",{id:`gpos-card-${r.replaceAll("_","-")}`,key:r,"onUpdate:modelValue":o=>l(s)[r]=o,type:"hidden"},null,8,He),[[F,l(s)[r]]])),64))]))}},Me=d=>{const s=document.getElementById("_gpos_nonce").value,n=g.random.getBytesSync(16),t=g.cipher.createCipher("AES-CBC",g.util.hexToBytes(g.md.sha256.create().update(s).digest().toHex()));return t.start({iv:n}),t.update(g.util.createBuffer(d,"utf8")),t.finish(),{hex:t.output.toHex(),iv:g.util.bytesToHex(n)}},Le=["value"],qe=["value"],et={__name:"Fragments",setup(d){const s=x("");return document.addEventListener("gpos-inputs-changed",async n=>{s.value=Me(JSON.stringify(n.detail))}),(n,t)=>(u(),c("div",null,[a("input",{type:"hidden",name:"_wp_refreshed_fragments",value:s.value.hex},null,8,Le),a("input",{type:"hidden",name:"_wp_fragment",value:s.value.iv},null,8,qe)]))}},ze={class:"w-full bg-red-200 text-red-700 p-3 rounded font-semibold flex gap-2"},tt={__name:"GatewayError",setup(d){return(s,n)=>(u(),c("div",ze,[h(l(P),{class:"w-10"}),A(" "+_(s.$t("gateway_error")),1)]))}},{card:v,requestedBin:B,binRequest:N}=f(m(L)),{checkBin:Ie}=m(L),j=window.jQuery,q=()=>{let d={};j(".gpos-checkout-class :input").each((s,n)=>{let t=j(n);if(!(t.attr("type")==="checkbox"&&!t.is(":checked"))){if(t.data("name")==="gpos-installment"){t.is(":checked")&&(d[t.data("name")]=t.val(),d["gpos-installment-rate"]=t.data("rate"));return}t.attr("id")&&(d[t.attr("id")]=t.val())}}),document.dispatchEvent(new CustomEvent("gpos-inputs-changed",{detail:d}))};W(v,q,{deep:!0});j(document).on({input:q},".gpos-checkout-class :input");document.addEventListener("gpos-inputs-changed",async()=>{var s;const d=(s=v.value.bin)==null?void 0:s.replace(/\D/g,"").slice(0,8);if(!d||d.length<8){B.value="",v.value.type="",v.value.brand="",v.value.family="",v.value.bank_name="",v.value.country="";return}B.value!==d&&(B.value=d,N.value&&N.value.abort(),Ie(d).then(n=>{var t,r,o,e,i,p,y;n.success&&(v.value.type=(t=n.data)==null?void 0:t.type,v.value.brand=(r=n.data)==null?void 0:r.scheme,v.value.family=(o=n.data)==null?void 0:o.family,v.value.bank_name=(i=(e=n.data)==null?void 0:e.bank)==null?void 0:i.name,v.value.country=(y=(p=n.data)==null?void 0:p.country)==null?void 0:y.name)}))});export{We as _,Xe as a,Ye as b,Ze as c,Ke as d,Pe as e,et as f,tt as g,q as i};
