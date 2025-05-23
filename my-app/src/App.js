import React from "react";
import { ChakraProvider, Box, Heading } from "@chakra-ui/react";
import { StackedImageSwap } from "./components/StackedImageSwap";

function App() {
  return (
    <ChakraProvider>
      <Box p={8}>
        <Heading mb={6}>Stacked Image Swap Animation</Heading>
        <StackedImageSwap />
      </Box>
    </ChakraProvider>
  );
}

export default App;
