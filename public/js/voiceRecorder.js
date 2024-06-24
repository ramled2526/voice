document.addEventListener('DOMContentLoaded', function () {
    let mediaRecorder;
    let audioChunks = [];
    const startButton = document.getElementById('start-recording');
    const stopButton = document.getElementById('stop-recording');
    const resetButton = document.getElementById('reset-recording');
    const audioPlayback = document.getElementById('audio-playback');
    const voiceDataInput = document.getElementById('voice-data');
    const downloadLinkContainer = document.getElementById('download-link-container');

    startButton.addEventListener('click', async () => {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });

        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const source = audioContext.createMediaStreamSource(stream);
        const destination = audioContext.createMediaStreamDestination();
        source.connect(destination);

        audioPlayback.srcObject = stream;
        audioPlayback.play();

        mediaRecorder = new MediaRecorder(destination.stream);

        mediaRecorder.ondataavailable = (event) => {
            audioChunks.push(event.data);
        };

        mediaRecorder.onstop = async () => {
            const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
            const audioUrl = URL.createObjectURL(audioBlob);
            audioPlayback.srcObject = null; 
            audioPlayback.src = audioUrl;

            const reader = new FileReader();
            reader.onloadend = () => {
                voiceDataInput.value = reader.result.split(',')[1];
            };
            reader.readAsDataURL(audioBlob);

            const downloadLink = document.createElement('a');
            downloadLink.href = audioUrl;
            downloadLink.download = 'recording.wav';
            downloadLink.textContent = 'Download recording';
            downloadLink.classList.add('btn', 'btn-link', 'd-block', 'mt-2');

            downloadLinkContainer.innerHTML = ''; 
            downloadLinkContainer.appendChild(downloadLink);
        };

        mediaRecorder.start();
        startButton.disabled = true;
        stopButton.disabled = false;
        resetButton.disabled = false;
    });

    stopButton.addEventListener('click', () => {
        mediaRecorder.stop();
        startButton.disabled = false;
        stopButton.disabled = true;
    });

    resetButton.addEventListener('click', () => {
        audioPlayback.srcObject = null;
        audioPlayback.src = '';
        voiceDataInput.value = '';
        audioChunks = [];
        startButton.disabled = false;
        stopButton.disabled = true;
        resetButton.disabled = true;
        downloadLinkContainer.innerHTML = ''; // Remove the download link
    });
});
