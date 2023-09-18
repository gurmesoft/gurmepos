import{b,o as u,c as p,a as t,w as g,Q as v,r as d,g as i,u as c,V as w,s as x,W as $,e as _,f,t as h,j as y,M as V}from"../vendor/main.js";import{u as k}from"../Page/main.js";const M={class:"flex gap-2 items-center"},T={class:"relative inline-flex items-center cursor-pointer"},S=t("div",{class:"w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"},null,-1),C={class:"ml-3 text-sm font-medium text-gray-900"},B={__name:"Toggle",props:["modelValue"],emits:["update:modelValue"],setup(r,{emit:s}){const o=r,n=b({get(){return o.modelValue},set(l){s("update:modelValue",l)}});return(l,a)=>(u(),p("div",M,[t("label",T,[g(t("input",{"onUpdate:modelValue":a[0]||(a[0]=e=>n.value=e),type:"checkbox",class:"sr-only peer"},null,512),[[v,n.value]]),S,t("span",C,[d(l.$slots,"default")])])]))}},E={"data-tooltip-target":"tooltip-bottom","data-tooltip-placement":"bottom"},N={id:"tooltip-bottom",role:"tooltip",class:"absolute z-10 invisible inline-block px-3 py-2 text-sm text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip w-64"},j=t("div",{class:"tooltip-arrow","data-popper-arrow":""},null,-1),D={__name:"Tooltip",setup(r){return(s,o)=>(u(),p("div",null,[t("button",E,[i(c(w),{class:"w-5 h-5 text-blue-600"})]),t("div",N,[d(s.$slots,"default"),j])]))}},O={class:"flex gap-2 items-center"},I={__name:"TestMode",setup(r){const s=k(),{isTestMode:o}=x(s),{t:n}=$(),l=async a=>{await s.updateTestMode(a);const e=jQuery("#wp-admin-bar-gurmepos");a?(e.addClass("gpos-test-mode-active"),e.children("a").children("span.ab-label").html(`POS Entegratör ${n("test_mode")}`)):(e.removeClass("gpos-test-mode-active"),e.children("a").children("span.ab-label").html("POS Entegratör"))};return(a,e)=>(u(),p("div",O,[i(B,{modelValue:c(o),"onUpdate:modelValue":e[0]||(e[0]=m=>y(o)?o.value=m:null),onChange:e[1]||(e[1]=m=>l(c(o)))},{default:_(()=>[f(h(a.$t("test_mode")),1)]),_:1},8,["modelValue"]),i(D,{class:"mt-1"},{default:_(()=>[f(h(a.$t("test_mode_content")),1)]),_:1})]))}},P={id:"alert-additional-content-4",class:"text-yellow-600 border border-yellow-200 rounded-lg bg-yellow-50",role:"alert"},Q={class:"flex items-center"},R={class:"text-yellow-600 text-lg font-medium"},U={class:"text-yellow-600 mt-2 mb-4 text-sm"},q={__name:"Warning",setup(r){return(s,o)=>(u(),p("div",P,[t("div",Q,[i(c(V),{class:"w-4 h-4 mr-2"}),t("h3",R,[d(s.$slots,"default")])]),t("div",U,[d(s.$slots,"content")])]))}};export{q as _,I as a};
