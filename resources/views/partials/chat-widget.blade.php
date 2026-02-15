<div x-data="{ 
    open: false, 
    messages: [
        { text: 'Hello! Welcome to ROLAD Properties. I am your AI Assistant. How can I help you today?', isBot: true }
    ],
    newMessage: '',
    sendMessage() {
        if (this.newMessage.trim() === '') return;
        
        // User Message
        this.messages.push({ text: this.newMessage, isBot: false });
        const userMsg = this.newMessage.toLowerCase();
        this.newMessage = '';

        // Simulate Bot Response
        setTimeout(() => {
            let botResponse = 'I can help with that. Would you like to speak with a live agent on WhatsApp?';
            
            if (userMsg.includes('price') || userMsg.includes('cost')) {
                botResponse = 'Our properties start from ₦2.5M. We have flexible payment plans available.';
            } else if (userMsg.includes('location') || userMsg.includes('where')) {
                botResponse = 'We have properties in Lagos, Ogun, and Ibadan. Which location are you interested in?';
            } else if (userMsg.includes('inspection') || userMsg.includes('visit')) {
                botResponse = 'You can book an inspection directly on our property pages. Would you like me to send you the link?';
            }

            this.messages.push({ text: botResponse, isBot: true });
            
            // Auto-scroll
            this.$nextTick(() => {
                const container = this.$refs.chatContainer;
                container.scrollTop = container.scrollHeight;
            });
        }, 800);
    }
}" class="fixed bottom-6 right-6 z-50">

    <!-- Toggle Button -->
    <button @click="open = !open"
        class="bg-primary text-white p-4 rounded-full shadow-lg hover:bg-primary-light transition duration-300 flex items-center justify-center">
        <svg x-show="!open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
            </path>
        </svg>
        <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Chat Window -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="absolute bottom-20 right-0 w-80 md:w-96 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col max-h-[500px]">

        <!-- Header -->
        <div class="bg-primary p-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-white mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-white text-sm">ROLAD AI Support</h3>
                    <p class="text-xs text-gray-200 flex items-center"><span
                            class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1"></span> Online</p>
                </div>
            </div>
            <button @click="open = false" class="text-white/80 hover:text-white"><svg class="w-5 h-5" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
        </div>

        <!-- Messages -->
        <div x-ref="chatContainer" class="flex-1 p-4 overflow-y-auto bg-gray-50 space-y-4 min-h-[300px]">
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.isBot ? 'flex justify-start' : 'flex justify-end'">
                    <div :class="msg.isBot ? 'bg-white text-gray-800 rounded-tl-none border-gray-100' : 'bg-primary text-white rounded-tr-none'"
                        class="px-4 py-3 rounded-2xl shadow-sm text-sm max-w-[80%] border">
                        <p x-text="msg.text"></p>
                    </div>
                </div>
            </template>
        </div>

        <!-- Input -->
        <div class="p-3 bg-white border-t border-gray-100">
            <div class="flex items-center bg-gray-100 rounded-full px-4 py-2">
                <input x-model="newMessage" @keydown.enter="sendMessage()" type="text" placeholder="Type a message..."
                    class="bg-transparent flex-1 outline-none text-sm text-gray-700">
                <button @click="sendMessage()" class="ml-2 text-primary hover:text-primary-light">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </div>
            <div class="mt-2 text-center">
                <a href="https://wa.me/2348000000000" target="_blank"
                    class="text-xs text-green-600 font-bold hover:underline flex items-center justify-center">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181 0.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                    Chat on WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>