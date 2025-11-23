import ollama

def chat_with_llama():
    while True:
        user_input = input("You: ")  # Get user input
        if user_input.lower() in ["exit", "quit"]:
            print("Goodbye!")
            break  # Exit the loop if user types 'exit' or 'quit'

        # Send input to Llama model
        response = ollama.chat(model="llama3.2:1b", messages=[{"role": "user", "content": user_input}])

        # Print AI response
        print("Llama:", response["message"]["content"])

if __name__ == "__main__":
    chat_with_llama()
