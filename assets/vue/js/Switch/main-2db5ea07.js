import{b as c,o as i,c as u,a as e,w as f,A as p,n as m,r}from"../vendor/main-fb93ded3.js";const b={class:"relative inline-flex cursor-pointer"},h=["value","disabled"],x=e("div",{class:"w-11 min-w-[2.75rem] h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"},null,-1),v={class:"flex flex-col gap-1"},g={class:"flex items-center"},_={class:"ml-3 text-xs font-normal text-gray-400"},k={__name:"Switch",props:["modelValue","disabled","value"],emits:["update:modelValue"],setup(t,{emit:o}){const n=t,l=c({get(){return n.modelValue},set(a){o("update:modelValue",a)}});return(a,s)=>(i(),u("div",null,[e("label",b,[f(e("input",{"onUpdate:modelValue":s[0]||(s[0]=d=>l.value=d),value:t.value,type:"checkbox",class:"sr-only peer",disabled:t.disabled},null,8,h),[[p,l.value]]),x,e("div",v,[e("div",g,[e("span",{class:m(`ml-3 text-sm font-medium ${t.disabled?"text-gray-300":"text-gray-900"}`)},[r(a.$slots,"default")],2)]),e("span",_,[r(a.$slots,"subtitle")])])])]))}};export{k as _};
