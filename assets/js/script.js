let localStream;
let RemoteStream;
let peerConnection;

const servers = {
    iceServer:[
        {
            urls:[]
        }
    ]
}

let init = async () => {
    localStream = await navigator.mediaDevices.getUserMedia({video:true,audio:false})
    document.getElementById('user-1').srcObject = localStream

    createOffer()
}

let createOffer = async() => {
    peerConnection = new RTCPeerConnection()

    RemoteStream = new MediaStream()
    document.getElementById('user-2').srcObject = RemoteStream

    let offer = await peerConnection.createOffer()
    await peerConnection.setLocalDescription(offer)
    
    console.log('offer : ', offer);
    
}

init()