import { Header } from '@/components/Header';
import '@/styles/Landing.css';

const Index = () => {
  return (
    <>
      <Header />
      <div className="landing-div">
        <h1>Welcome to our MARKETPLACE</h1>
      </div>
      <footer className="footer">
        <p>
          Our platform connects buyers and sellers in one place, enabling easy buying
          and selling of products and services with secure and fast transactions
        </p>
      </footer>
    </>
  );
};

export default Index;
