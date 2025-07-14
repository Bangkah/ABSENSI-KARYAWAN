import toast from "../toast.js";
import { fetchWithToken, toFormurlenconded } from "../utils.js";

const QRCodeScannerModal = document.getElementById("qrcode-scanner-modal");
let html5QrcodeScanner;

QRCodeScannerModal.addEventListener("show.bs.modal", (event) => {
    const isEnter = event.relatedTarget.dataset.isEnter === "1";
    const url = isEnter ? enterPresenceUrl : outPresenceUrl;

    function onScanSuccess(code) {
        handlePresence(url, code);
        html5QrcodeScanner.clear();
        const modal = bootstrap.Modal.getInstance(QRCodeScannerModal);
        modal.hide();
    }

    html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: { width: 250, height: 250 },
            formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
            rememberLastUsedCamera: false,
        },
        false
    );

    html5QrcodeScanner.render(onScanSuccess);
});

QRCodeScannerModal.addEventListener("hidden.bs.modal", () => {
    if (html5QrcodeScanner) {
        html5QrcodeScanner.clear().catch((error) => {
            console.error("Failed to clear scanner", error);
        });
    }
});

async function handlePresence(baseurl, code) {
    try {
        const res = await fetchWithToken(baseurl, {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            },
            body: toFormurlenconded({ code }),
        });

        const data = await res.json();

        toast.show({
            title: "QRCode Absensi Pesan",
            body: data.message || "Absensi berhasil",
            colorClass: data.success ? toast.TOAST_SUCCESS : toast.TOAST_DANGER,
        });

        // reload setelah beberapa detik jika berhasil
        if (data.success) {
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    } catch (error) {
        console.error("QR Code Absen Error:", error);

        toast.show({
            title: "Gagal Absen",
            body: "Terjadi kesalahan saat absen, coba lagi.",
            colorClass: toast.TOAST_DANGER,
        });
    }
}
