
export const sendHTTPrequest =async(url,options)=>{ //mando los datos al server (en fomrato TEXTO!)

    const res = await fetch(url,options);
    const data = await res.json();
    
    return data
}

