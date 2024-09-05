document.addEventListener('DOMContentLoaded', function () {
    let mediaRecorder;
    let audioChunks = [];
    let audioContext;
    let source;
    let analyser;
    let processor;
    const startButton = document.getElementById('start-recording');
    const stopButton = document.getElementById('stop-recording');
    const resetButton = document.getElementById('reset-recording');
    const audioPlayback = document.getElementById('audio-playback');
    const voiceDataInput = document.getElementById('voice-data');
    const downloadLinkContainer = document.getElementById('download-link-container');

    startButton.addEventListener('click', async () => {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            audioContext = new AudioContext();
            source = audioContext.createMediaStreamSource(stream);
            analyser = audioContext.createAnalyser();
            processor = audioContext.createScriptProcessor(1024, 1, 1);
            
            analyser.fftSize = 2048;
            const bufferLength = analyser.frequencyBinCount;
            const dataArray = new Float32Array(bufferLength);

            source.connect(analyser);
            analyser.connect(processor);
            processor.connect(audioContext.destination);

            processor.onaudioprocess = (e) => {
                analyser.getFloatFrequencyData(dataArray);
                const inputData = e.inputBuffer.getChannelData(0);
                const outputData = e.outputBuffer.getChannelData(0);

                // Simple spectral subtraction noise reduction
                const noiseReductionFactor = 0.5;
                for (let i = 0; i < inputData.length; i++) {
                    const noise = dataArray[i] * noiseReductionFactor;
                    outputData[i] = inputData[i] - noise;
                }
            };

            audioPlayback.srcObject = stream;
            audioPlayback.play();

            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.ondataavailable = (event) => {
                audioChunks.push(event.data);
            };

            mediaRecorder.onstop = async () => {
                const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });
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
                downloadLink.download = 'recording.webm';
                downloadLink.textContent = 'Download recording';
                downloadLink.classList.add('btn', 'btn-link', 'd-block', 'mt-2');

                downloadLinkContainer.innerHTML = '';
                downloadLinkContainer.appendChild(downloadLink);
            };

            mediaRecorder.start();
            startButton.disabled = true;
            stopButton.disabled = false;
            resetButton.disabled = false;
        } catch (error) {
            console.error('Error accessing audio stream:', error);
        }
    });

    stopButton.addEventListener('click', () => {
        if (mediaRecorder && mediaRecorder.state !== 'inactive') {
            mediaRecorder.stop();
            startButton.disabled = false;
            stopButton.disabled = true;

            if (processor) {
                processor.disconnect();
                processor.onaudioprocess = null;
            }
            if (source) {
                source.disconnect();
            }
            if (audioContext) {
                audioContext.close();
            }
        }
    });

    resetButton.addEventListener('click', () => {
        if (audioPlayback.srcObject) {
            const tracks = audioPlayback.srcObject.getTracks();
            tracks.forEach(track => track.stop());
        }
        audioPlayback.srcObject = null;
        audioPlayback.src = '';
        voiceDataInput.value = '';
        audioChunks = [];
        startButton.disabled = false;
        stopButton.disabled = true;
        resetButton.disabled = true;
        downloadLinkContainer.innerHTML = '';
    });
});
